<?php
namespace App\Http\Controllers\Api;

use App\Console\encription;
use App\Http\Controllers\DataserverController;
use App\Mail\Emailtrans;
use App\Models\bill_payment;
use App\Models\bo;
use App\Models\data;
use App\Models\interest;
use App\Models\server;
use App\Models\wallet;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\CentralLogics\Helpers;
use Mockery\Exception;

class BillController
{

    public function data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'amount' => 'required',
            'number' => 'required',
            'refid' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $this->error_processor($validator)
            ], 403);
        }
        $apikey = $request->header('apikey');
        $user = User::where('apikey',$apikey)->first();
        if ($user) {
            $wallet = wallet::where('username', $user->username)->first();

            if ($wallet->balance < $request->amount) {
                $mg = "You Cant Make Purchase Above " . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                return response()->json([
                    'message' => $mg,
                    'user' => $user,
                    'success' => 0
                ], 200);

            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                return response()->json([
                    'message' => $mg,
                    'user' => $user,
                    'success' => 0
                ], 200);

            }
            $bo = bill_payment::where('transactionid', $request->refid)->first();;
            if (isset($bo)) {
                $mg = "duplicate transaction";
                return response()->json([
                    'message' => $mg,
                    'user' => $user,
                    'success' => 0
                ], 200);

            } else {
                $bt = data::where("plan_id", $request->code)->first();
                if (!isset($bt)) {
                    return response()->json([
                        'message' => "invalid code, check and try again later",
                        'user' => $user,
                        'success' => 0
                    ], 200);
                }
                $gt = $wallet->balance - $request->amount;


                $wallet->balance = $gt;
                $wallet->save();

                    $daterserver = new DataserverController();

                        $object = json_decode($bt);
                        $object->number = $request->number;
                        $json = json_encode($object);

                        $mcd = server::where('status', "1")->first();
                        if ($mcd->name == "honorworld") {
                            $response = $daterserver->honourwordbill($object);
                        }else if ($mcd->name == "mcd") {
                            $response = $daterserver->mcdbill($object);
                        }
                        // echo $response;


                        $data = json_decode($response, true);
                        if (isset($data['result'])){
                            $success=$data['result'];
                        }else{
                            $success=$data["success"];
                        }
                        if ($success==1) {
                            $bo = bill_payment::create([
                                'username' => $user->username,
                                'product' => $bt->network . '|' . $bt->plan,
                                'amount' => $request->amount,
                                'server_response' => 'ur fault',
                                'status' => 1,
                                'number' => $request->number,
                                'transactionid' =>'api'. $request->refid,
                                'discountamount' => 0,
                                'paymentmethod' => 'wallet',
                                'balance' => $gt,
                            ]);

                            $bo['name']=encription::decryptdata($user->name);
                            $name = $bt->plan;
                            $am = "$bt->plan  was successful delivered to";
                            $ph = $request->number;

                            $receiver =encription::decryptdata($user->email);
                            $admin = 'info@renomobilemoney.com';
//                            $admin2 = 'primedata18@gmail.com';

                        Mail::to($receiver)->send(new Emailtrans($bo));
                        Mail::to($admin)->send(new Emailtrans($bo));
//                        Mail::to($admin2)->send(new Emailtrans($bo));



                            return response()->json([
                                'message' => $am, 'name' => $name, 'ph' => $ph, 'success' => $success,
                                'user' => $user
                            ], 200);

                        }elseif ($success==0){
                            $zo=$wallet->balance+$request->amount;
                            $wallet->balance = $zo;
                            $wallet->save();

                            $name= $bt->plan;
                            $am= "NGN $request->amount Was Refunded To Your Wallet";
                            $ph=", Transaction fail";
                            return response()->json([
                                'message' => $am, 'name' => $name, 'ph'=>$ph, 'success'=>$success,
                                'user' => $user
                            ], 200);


                        }

            }
        }else {
            return response()->json([
                'message' => "User not found",
            ], 200);

        }
    }

    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
}



