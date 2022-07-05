<?php

namespace App\Http\Controllers;

use App\Console\encription;
use App\Mail\Emailtrans;
use App\Models\bill_payment;
use App\Models\bo;
use App\Models\data;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AirtimeController
{
    public function airtime(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

            $user = User::find($request->user()->id);
            $wallet = wallet::where('username', $user->username)->first();


            if ($wallet->balance < $request->amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                Alert::error('error', $mg);
                return back();

            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                Alert::error('error', $mg);
                return back();

            }
            $bo = bill_payment::where('transactionid', $request->refid)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction";
                Alert::info('info', $mg);
                return back();

            } else {
                $user = User::find($request->user()->id);
                $bt = data::where("cat_id", $request->id)->first();
                $wallet = wallet::where('username', $user->username)->first();


                $gt = $wallet->balance - $request->amount;


                $wallet->balance = $gt;
                $wallet->save();


                $resellerURL = 'https://app.mcd.5starcompany.com.ng/api/reseller/';
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL =>$resellerURL.'pay',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('service' => 'airtime', 'coded' => $request->id, 'phone' => $request->number, 'amount' => $request->amount, 'reseller_price' => $request->amount),

                    CURLOPT_HTTPHEADER => array(
                        'Authorization: mcd_key_75rq4][oyfu545eyuriup1q2yue4poxe3jfd'
                    )));

                $response = curl_exec($curl);

                curl_close($curl);
//                    echo $response;
//    return;
                $data = json_decode($response, true);
                $success = $data["success"];
                $tran1 = $data["discountAmount"];

//                        return $response;
                if ($success == 1) {

                    $bo = bill_payment::create([
                        'username' => $user->username,
                        'product' => $request->id.'Airtime',
                        'amount' => $request->amount,
                        'server_response' => $response,
                        'status' => $success,
                        'number' => $request->number,
                        'paymentmethod'=>'wallet',
                        'transactionid' => $request->refid,
                        'discountamount' => $tran1,
                        'balance'=>$gt,
                    ]);

//                    $name = $bt->plan;
                    $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                    $ph = $request->number;

                    $receiver = encription::decryptdata($user->email);
                    $admin = 'info@renomobilemoney.com';
//                    $admin2= 'primedata18@gmail.com';

                    Mail::to($receiver)->send(new Emailtrans($bo));
                    Mail::to($admin)->send(new Emailtrans($bo));
//                    Mail::to($admin2)->send(new Emailtrans($bo));

                    Alert::success('success', $am.' ' .$ph);
                    return back();
                } elseif ($success == 0) {
                    $zo = $user->balance + $request->amount;
                    $user->balance = $zo;
                    $user->save();

//                    $name = $bt->plan;
                    $am = "NGN $request->amount Was Refunded To Your Wallet";
                    $ph = ", Transaction fail";

                    Alert::error('error', $am.' ' .$ph);
                    return back();
                }
        }
    }
    public function honor(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $user = User::find($request->user()->id);
        $wallet = wallet::where('username', $user->username)->first();


        if ($wallet->balance < $request->amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

            Alert::error('error', $mg);
            return back();

        }
        if ($request->amount < 0) {

            $mg = "error transaction";
            return view('bill', compact('user', 'mg'));

        }
        $bo = bill_payment::where('transactionid', $request->refid)->first();
        if (isset($bo)) {
            $mg = "duplicate transaction";
            return view('bill', compact('user', 'mg'));

        } else {
            $user = User::find($request->user()->id);
            $bt = data::where("id", $request->id)->first();
            $wallet = wallet::where('username', $user->username)->first();


            $gt = $wallet->balance - $request->amount;


            $wallet->balance = $gt;
            $wallet->save();


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.honourworld.com.ng/api/v1/purchase/airtime',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
  "network" : "'.$request->id.'",
  "phone" : "'.$request->number.'",
  "amount" : "'.$request->amount.'"
}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer sk_live_ac82a88e-743f-4937-a516-10222493fed5',
                    'Accept: application/json',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            echo $response;

            $data = json_decode($response, true);
//            $success = $data["message"];
//            $tran1 = $data["discountAmount"];

//                        return $response;
            if ($data['message']== 'SUCCESSFUL') {

                $bo = bill_payment::create([
                    'username' => $user->username,
                    'product' => $request->id.'Airtime',
                    'amount' => $request->amount,
                    'server_response' => $response,
                    'status' => '1',
                    'number' => $request->number,
                    'paymentmethod'=>'wallet',
                    'transactionid' => $request->refid,
                    'discountamount' =>0,
                ]);

                $success=1;
                $name = "Airtime";
                $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                $ph = $request->number;

                $receiver = encription::decryptdata($user->email);
                $admin = 'info@renomobilemoney.com';
//                    $admin2= 'primedata18@gmail.com';

                Mail::to($receiver)->send(new Emailtrans($bo));
                Mail::to($admin)->send(new Emailtrans($bo));
//                    Mail::to($admin2)->send(new Emailtrans($bo));

                Alert::success('success', $am.' ' .$ph);
                return back();
            } elseif ($data['message']== 'Possible duplicate transaction, Please retry after 2 minutes') {
                $zo = $user->balance + $request->amount;
                $user->balance = $zo;
                $user->save();
$success=0;
                $name = 'Airtime';
                $am = "NGN $request->amount Was Refunded To Your Wallet";
                $ph = ", Possible duplicate transaction, Please retry after 2 minutesl";

                return view('bill', compact('user', 'name', 'am', 'ph', 'success'));

            } elseif ($data['message']== 'Failed') {
                $zo = $user->balance + $request->amount;
                $user->balance = $zo;
                $user->save();
                $success=0;
                $name = 'Airtime';
                $am = "NGN $request->amount Was Refunded To Your Wallet";
                $ph = ", Transaction fail";

                Alert::error('error', $am.' ' .$ph);
                return back();
            }
        }

        }
}
