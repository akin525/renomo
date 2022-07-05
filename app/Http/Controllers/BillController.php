<?php
namespace App\Http\Controllers;
use App\Console\encription;
use App\Mail\Emailfund;
use App\Mail\Emailtrans;
use App\Models\big;
use App\Models\bill_payment;
use App\Models\bo;
use App\Models\data;
use App\Models\deposit;
use App\Models\profit;
use App\Models\profit1;
use App\Models\server;
use App\Models\setting;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{

    public function bill(Request $request)
    {
        $request->validate([
            'productid' => 'required',
        ]);
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $wallet = wallet::where('username', $user->username)->first();
            $serve = server::where('status', '1')->first();
            if ($serve->name == 'honorworld') {
                $product = big::where('id', $request->productid)->first();
            } elseif ($serve->name == 'mcd') {
                $product = data::where('id', $request->productid)->first();
            }

            if ($user->apikey == '') {
                $amount = $product->tamount;
            } elseif ($user != '') {
                $amount = $product->ramount;
            }

            if ($wallet->balance < $amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                Alert::error('error', $mg);
                return redirect(route('dashboard'))
                    ->with('error', $mg);

            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                Alert::error('error', $mg);
                return redirect(route('dashboard'))
                    ->with('error', $mg);

            }
            $bo = bill_payment::where('transactionid', $request->id)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction";
                Alert::error('error', $mg);
                return redirect(route('dashboard'))
                    ->with('error', $mg);

            } else {
                $user = User::find($request->user()->id);
//                $bt = data::where("id", $request->productid)->first();
                $wallet = wallet::where('username', $user->username)->first();


                $gt = $wallet->balance - $request->amount;


                $wallet->balance = $gt;
                $wallet->save();

                $object = json_decode($product);
                $object->number = $request->number;
                $json = json_encode($object);

                $daterserver = new DataserverController();
                $mcd = server::where('status', "1")->first();

                if ($mcd->name == "honorworld") {
                    $response = $daterserver->honourwordbill($object);
//return $response;
                    $data = json_decode($response, true);
                    $success = "";
                    if ($data['code'] == '200') {
                        $success = 1;
                        $ms = $data['message'];

//                    echo $success;

                        $po = $amount - $product->amount;

                        $bo = bill_payment::create([
                            'username' => $user->username,
                            'product' => $product->network . '|' . $product->plan,
                            'amount' => $request->amount,
                            'server_response' => $response,
                            'status' => $success,
                            'number' => $request->number,
                            'transactionid' => $request->id,
                            'paymentmethod'=>'wallet',
                            'discountamount'=>0,
                            'balance'=>$gt,
                        ]);

                        $profit = profit1::create([
                            'username' => $user->username,
                            'plan' => $product->network . '|' . $product->plan,
                            'amount' => $po,
                        ]);

//                        $name = $product->plan;
                        $am = "$product->plan  was successful delivered to";
                        $ph = $request->number;


                        $receiver = encription::decryptdata($user->email);
                        $admin = 'info@renomobilemoney.com';

//                        $admin2 = 'primedata18@gmail.com';

                        Mail::to($receiver)->send(new Emailtrans($bo));
                        Mail::to($admin)->send(new Emailtrans($bo));
//                        Mail::to($admin2)->send(new Emailtrans($bo));

                        Alert::success('success', $am.' ' .$ph);
                        return redirect(route('dashboard'))
                            ->with('success', $am.' ' .$ph);
                    } elseif ($data['code'] == '300') {
                        $success = 0;
                        $zo = $wallet->balance + $request->amount;
                        $wallet->balance = $zo;
                        $wallet->save();

                        $name = $product->plan;
                        $am = "NGN $request->amount Was Refunded To Your Wallet";
                        $ph = ", Transaction fail";

                        Alert::error('error', $am.' ' .$ph);
                        return redirect(route('dashboard'))
                            ->with('error', $am.' ' .$ph);
                    }
                } else if ($mcd->name == "mcd") {
                    $response = $daterserver->mcdbill($object);

                    $data = json_decode($response, true);

                    if (isset($data['success'])) {
                        $dis=$data['discountAmount'];
//                    echo $success;
                        $success = "1";
                        $po = $amount - $product->amount;

                        $bo = bill_payment::create([
                            'username' => $user->username,
                            'product' => $product->network . '|' . $product->plan,
                            'amount' => $request->amount,
                            'server_response' => $response,
                            'status' => $success,
                            'number' => $request->number,
                            'transactionid' => $request->id,
                            'discountamount'=>$dis,
                            'paymentmethod'=> 'wallet',
                            'balance'=>$gt,
                        ]);

                        $profit = profit::create([
                            'username' => $user->username,
                            'plan' => $product->network . '|' . $product->plan,
                            'amount' => $po,
                        ]);

                        $name = $product->plan;
                        $am = "$product->plan  was successful delivered to";
                        $ph = $request->number;


                        $receiver = encription::decryptdata($user->email);
                        $admin = 'info@renomobilemoney.com';


                        Mail::to($receiver)->send(new Emailtrans($bo));
                        Mail::to($admin)->send(new Emailtrans($bo));
//                        Mail::to($admin2)->send(new Emailtrans($bo));

                        Alert::success('success', $am.' ' .$ph);
                        return redirect(route('dashboard'))
                            ->with('success', $am.' ' .$ph);
                    }elseif (!isset($data['success'])) {
                        $success = 0;
                        $zo = $wallet->balance + $request->amount;
                        $wallet->balance = $zo;
                        $wallet->save();

                        $name = $product->plan;
                        $am = "NGN $request->amount Was Refunded To Your Wallet";
                        $ph = ", Transaction fail";
                        Alert::error('error', $am.' ' .$ph);
                        return redirect(route('dashboard'))
                            ->with('error', $am.' ' .$ph);
                    }

                }


//return $response;
            }
        }
    }
}




