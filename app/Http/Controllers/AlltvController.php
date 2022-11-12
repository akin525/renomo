<?php

namespace app\Http\Controllers;

use App\Console\encription;
use App\Mail\Emailotp;
use App\Mail\Emailtrans;
use App\Models\big;
use App\Models\bill_payment;
use App\Models\bo;
use App\Models\data;
use App\Models\Messages;
use App\Models\refer;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AlltvController
{
    public function listtv(Request $request)
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
            CURLOPT_POSTFIELDS => array('service' => 'tv'),
            CURLOPT_HTTPHEADER => array(
                'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        return $response;
        $data = json_decode($response, true);
        $plan1= $data["data"];
        foreach ($plan1 as $plan){
            $success =$plan["type"];
            $planid = $plan["code"];
            $price= $plan['amount'];
            $allowance=$plan['name'];
            $insert= data::create([
                'plan_id' =>$planid,
                'network' =>$success,
                'plan' =>$allowance,
                'code' =>$planid,
                'amount'=>$price,
                'tamount'=>$price,
                'ramount'=>$price,
                'cat_id'=>$planid,
            ]);
        }

    }

    public function verifytv(Request $request)
    {
//        return $request;
        $ve=data::where('id', $request->id)->first();
//        return $request;

//return $ve;
        $resellerURL='https://integration.mcd.5starcompany.com.ng/api/reseller/';


        $curl = curl_init();


        curl_setopt_array($curl, array(

            CURLOPT_URL => $resellerURL.'validate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('service' => 'tv', 'coded' =>$ve->network, 'phone' => $request->number),
            CURLOPT_HTTPHEADER => array(
                'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
            )
        ));

                $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
//return $response;
        $data = json_decode($response, true);
        $success= $data["success"];
        $name=$data["data"];
        if ($success = 1){
            $log=$name;
        }else{
            $log= "Unable to Identify IUC Number";
        }
        return view('tvp', compact('log', 'request', 'name'));


    }
//    public function process(Request $request)
//    {
//        if (Auth::check()) {
//            $user = User::find($request->user()->id);
//            $tv = data::where('id', $request->id)->first();
//
//            return  view('tvp', compact('user', 'request'));
//
//        }
//        return redirect("login")->withSuccess('You are not allowed to access');
//
//    }
    public function tv(Request $request)
    {

            $user = User::find($request->user()->id);
            $tv = data::where('network', $request->id)->get();

            return  view('tv', compact('user', 'tv'));

        return redirect("login")->withSuccess('You are not allowed to access');

    }

        public function paytv(Request $request)
        {
            if (Auth::check()) {
                $user = User::find($request->user()->id);
                $tv = data::where('id', $request->id)->first();

                $wallet = wallet::where('username', $user->username)->first();


                if ($wallet->balance < $tv->tamount) {
                    $mg = "You Cant Make Purchase Above" . "NGN" . $tv->tamount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                    return view('bill', compact('user', 'mg'));

                }
                if ($tv->tamount < 0) {

                    $mg = "error transaction";
                    return view('bill', compact('user', 'mg'));

                }
                $bo = bo::where('refid', $request->refid)->first();
                if (isset($bo)) {
                    $mg = "duplicate transaction";
                    return view('bill', compact('user', 'mg'));

                } else {
                    $gt = $wallet->balance - $tv->tamount;


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
                        CURLOPT_POSTFIELDS => array('service' => 'tv', 'coded' => $tv->cat_id, 'phone' => $request->number),
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: mcd_key_75rq4][oyfu545eyuriup1q2yue4poxe3jfd'
                        )
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
//                    echo $response;
                    $data = json_decode($response, true);
                    $success = $data["success"];
                    $tran1 = $data["discountAmount"];

//                        return $response;
                    if ($success == 1) {

                        $bo =bill_payment::create([
                            'username' => $user->username,
                            'product' => $tv->plan,
                            'amount' => $tv->tamount,
                            'server_response' => $response,
                            'status' => $success,
                            'phone' => $request->number,
                            'transactionid' => $request->refid,
                            'discountamount' => $tran1,
                            'paymentmethod'=>'wallet',
                        ]);


                        $name = $tv->plan;
                        $am = $tv->network."was Successful to";
                        $ph = $request->number;

                        $receiver = encription::decryptdata($user->email);
                        $admin = 'info@renomobilemoney.com';


                        Mail::to($receiver)->send(new Emailtrans($bo));
                        Mail::to($admin)->send(new Emailtrans($bo));

                        return redirect()->route('viewpdf', $bo->id);


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

    public function createemail(Request $request)
    {
        $input['email']="uyewye";
        $input['username']="ewhdhede";
        $input['name']="hdhhsfdf";
        $input['password']="shsajhfshf";

        Mail::to("odejinmiabraham@gmail.com")->send(new Emailotp($input));
        return "Hello guys how are you";
    }

}
