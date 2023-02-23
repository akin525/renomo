<?php

namespace app\Http\Controllers;

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

class EkectController
{
    public function listelect()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://integration.mcd.5starcompany.com.ng/api/reseller/list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('service' => 'electricity'),
            CURLOPT_HTTPHEADER => array(
                'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        return $response;

        $data = json_decode($response, true);
        $plan1= $data["data"];
        foreach ($plan1 as $plan){
//            $success =$plan["type"];
            $planid = $plan["code"];
//            $price= $plan['amount'];
            $allowance=$plan['name'];
            $insert= data::create([
                'plan_id' =>$planid,
                'network' =>'elect',
                'plan' =>$allowance,
                'code' =>$planid,
                'amount'=>0,
                'tamount'=>0,
                'ramount'=>0,
                'cat_id'=>$planid,
            ]);
        }
    }
    public function electric(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = data::where('network', 'elect')->get();

            return  view('elect', compact('user', 'tv'));

        }
        return redirect("login")->withSuccess('You are not allowed to access');

    }
    public function verifyelect(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = data::where('id', $request->id)->first();


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://integration.mcd.5starcompany.com.ng/api/reseller/validate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('service' => 'electricity', 'coded' => $tv->cat_id, 'phone' => $request->number),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            echo $response;
            $data = json_decode($response, true);
            $success= $data["success"];
            $name=$data["data"];
            if ($success = 1){
                $log=$name;
            }else{
                $log= "Unable to Identify meter Number";
            }
            return view('payelect', compact('log', 'request', 'name'));


        }
    }
    public function payelect(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = data::where('id', $request->id)->first();

            $wallet = wallet::where('username', $user->username)->first();


            if ($wallet->balance < $request->amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                return view('bill', compact('user', 'mg'));

            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                return view('bill', compact('user', 'mg'));

            }
            $bo = bo::where('refid', $request->refid)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction";
                return view('bill', compact('user', 'mg'));

            } else {
                $gt = $wallet->balance - $request->amount;


                $wallet->balance = $gt;
                $wallet->save();
                $resellerURL = 'https://integration.mcd.5starcompany.com.ng/api/reseller/';


                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $resellerURL.'pay',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('service' => 'electricity', 'coded' => $tv->cat_id, 'phone' => $request->number, 'amount' => $request->amount),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: mcd_key_75rq4][oyfu545eyuriup1q2yue4poxe3jfd'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
//                echo $response;

                $data = json_decode($response, true);
                $success = $data["success"];
                $tran1 = $data["discountAmount"];
                $tran2 = $data["token"];

//                        return $response;
                if ($success == 1) {

                    $bo =bill_payment::create([
                        'username' => $user->username,
                        'product' => $tv->plan,
                        'amount' => $request->amount,
                        'server_response' => $response,
                        'status' => $success,
                        'number' => $request->number,
                        'transactionid' => $request->refid,
                        'discountamount' => $tran1,
                        'token'=>$tran2,
                        'paymentmethod'=>'wallet',
                    ]);


                    $name = $tv->plan;
                    $am = $tv->network."was Successful to";
                    $ph = $request->number."| Token:".$tran2;

                    $receiver = encription::decryptdata($user->email);
                    $admin = 'info@renomobilemoney.com';

                    Mail::to($receiver)->send(new Emailtrans($bo));
                    Mail::to($admin)->send(new Emailtrans($bo));

                    return view('bill', compact('user', 'name', 'am', 'ph', 'success'));


                }elseif ($success==0){
                    $zo=$user->balance+$tv->tamount;
                    $user->balance = $zo;
                    $user->save();

                    $name= $tv->network;
                    $am= "NGN $request->amount Was Refunded To Your Wallet";
                    $ph=", Transaction fail";

                    return view('bill', compact('user', 'name', 'am', 'ph', 'success'));

                }
            }
        }
    }

}
