<?php

namespace App\Http\Controllers;

use App\Console\encription;
use App\Mail\Emailtrans;
use App\Models\bill_payment;
use App\Models\bo;
use App\Models\Comission;
use App\Models\data;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AirtimeController
{
    public function listairtimecommission()
    {
        $allcommission=Comission::where('username', Auth::user()->username)->latest()->get();

        return view("commission", compact("allcommission"));
    }

    public function pintransaction(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'number' => 'required',
            'id' => 'required',
        ]);
        $user = User::find($request->user()->id);
        $wallet = wallet::where('username', $user->username)->first();


        if ($wallet->balance < $request->amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

            Alert::error('Fail', $mg);
            return back();


        }
        if ($request->amount < 0) {

            $mg = "error transaction";
            Alert::error('error', $mg);
            return back();


        }


        return view('pin', compact('request'));
    }

    public function pinimport(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $user = User::find($request->user()->id);
        $wallet = wallet::where('username', $user->username)->first();
        if ($wallet->balance < $request->amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

            Alert::error('Ooops..',$mg);
            return redirect('invoice');


        }
        if ($request->amount < 0) {

            $mg = "error transaction";
            Alert::error('error', $mg);
            return redirect('invoice');


        }
        $bo = bill_payment::where('transactionid', $request->refid)->first();
        if (isset($bo)) {
            $mg = "duplicate transaction";
            Alert::info('info', $mg);
//                Alert::image('Ooops..',$mg,'https://renomobilemoney.com/nov.jpeg','200','200', 'Image Alt');

            return redirect('invoice');

        } else {

            $user = User::find($request->user()->id);
            $bt = data::where("cat_id", $request->id)->first();
            $wallet = wallet::where('username', $user->username)->first();
            $per=2/100;
            $comission=$per*$request->amount;

            $fbalance=$wallet->balance;

            $gt = $wallet->balance - $request->amount;
            $wallet->balance = $gt;
            $wallet->save();
            if (Auth::user()->pin !="0"){
                $pi=$request->pin;
                $pe=Auth::user()->pin;
                if ($pi != $pe){
                    Alert::error('Ooops', 'incorrect pin');
                    return redirect('airtime');
                }else{


                    $bo = bill_payment::create([
                        'username' => $user->username,
                        'product' => $request->id.'Airtime',
                        'amount' => $request->amount,
                        'server_response' => 0,
                        'status' => 0,
                        'number' => $request->number,
                        'paymentmethod'=>'wallet',
                        'transactionid' => $request->refid,
                        'discountamount' => 0,
                        'fbalance'=>$fbalance,
                        'balance'=>$gt,
                    ]);
                    $comiS=Comission::create([
                        'username'=>Auth::user()->username,
                        'amount'=>$comission,
                    ]);
                    $bo['name']=encription::decryptdata($user->name);
                    $bo['email']=encription::decryptdata(Auth::user()->email);

                    $resellerURL = 'https://integration.mcd.5starcompany.com.ng/api/reseller/';
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
                    $data = json_decode($response, true);
                    $success = $data["success"];
                    $tran1 = $data["discountAmount"];
                    if ($success == 1) {
//                    $bo->server_response=$response;
//                    $bo->status=1;
//                    $bo->save();
                        $update=bill_payment::where('id', $bo->id)->update([
                            'server_response'=>$response,
                            'status'=>1,
                        ]);
                        $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                        $ph = $request->number;

                        $receiver = encription::decryptdata($user->email);
                        $admin = 'info@renomobilemoney.com';


                        Mail::to($receiver)->send(new Emailtrans($bo));
                        Mail::to($admin)->send(new Emailtrans($bo));
                        $username=encription::decryptdata($user->username);
                        $name="Airtime";
                        $body=$username.' purchase '.$name;
                        $this->reproduct($username, "User AirtimePurchase", $body);
                        $this->reproduct1($username, "User AirtimePurchase", $body);
                        $this->reproduct2($username, "User AirtimePurchase", $body);

                        $com=$wallet->balance+$comission;
                        $wallet->balance=$com;
                        $wallet->save();

                        $parise=$comission."₦ Commission Is added to your wallet balance";
                        Alert::success('success', $am.' ' .$ph.' & '.$parise);
//                    $msg=$am.' ' .$ph.' & '.$parise;
//                    Alert::image('Success..',$msg,'https://renomobilemoney.com/nov.jpeg','200','200', 'Image Alt');

                        return redirect()->route('viewpdf', $bo->id);
                    } elseif ($success == 0) {
//                        $zo = $wallet->balance + $request->amount;
//                        $wallet->balance = $zo;
//                        $wallet->save();

//                    $name = $bt->plan;
                        $am = "NGN $request->amount Was Refunded To Your Wallet";
                        $ph = ", Transaction fail";

                        Alert::error('error', $am.' ' .$ph);
                        return redirect()->route('viewpdf', $bo->id);
                    }
                }

            }


        }




    }

    public function airtime(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

            $user = User::find($request->user()->id);
            $wallet = wallet::where('username', $user->username)->first();


            if ($wallet->balance < $request->amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                Alert::image('Ooops..',$mg,'https://renomobilemoney.com/nov.jpeg','200','200', 'Image Alt');
                return redirect('invoice');


            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                Alert::error('error', $mg);
                return redirect('invoice');


            }
            $bo = bill_payment::where('transactionid', $request->refid)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction";
                Alert::info('info', $mg);
//                Alert::image('Ooops..',$mg,'https://renomobilemoney.com/nov.jpeg','200','200', 'Image Alt');

                return redirect('invoice');

            } else {

                $user = User::find($request->user()->id);
                $bt = data::where("cat_id", $request->id)->first();
                $wallet = wallet::where('username', $user->username)->first();
                $per=2/100;
                $comission=$per*$request->amount;
                $fbalance=$wallet->balance;


                $gt = $wallet->balance - $request->amount;

                $wallet->balance = $gt;
                $wallet->save();
                if (Auth::user()->pin !="0"){
                    $pi=$request->pin;
                    $pe=Auth::user()->pin;
                    if ($pi != $pe){
                        Alert::error('Ooops', 'incorrect pin');
                        return back();
                    }else{

                        $bo = bill_payment::create([
                            'username' => $user->username,
                            'product' => $request->id.'Airtime',
                            'amount' => $request->amount,
                            'server_response' => 0,
                            'status' => 0,
                            'number' => $request->number,
                            'paymentmethod'=>'wallet',
                            'transactionid' => $request->refid,
                            'discountamount' => 0,
                            'fbalance'=>$fbalance,
                            'balance'=>$gt,
                        ]);
                        $comiS=Comission::create([
                            'username'=>Auth::user()->username,
                            'amount'=>$comission,
                        ]);
                        $bo['name']=encription::decryptdata($user->name);
                        $bo['email']=encription::decryptdata(Auth::user()->email);

                        $resellerURL = 'https://integration.mcd.5starcompany.com.ng/api/reseller/';
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
                        $data = json_decode($response, true);
                        $success = $data["success"];
                        $tran1 = $data["discountAmount"];
                        if ($success == 1) {
//                    $bo->server_response=$response;
//                    $bo->status=1;
//                    $bo->save();
                            $update=bill_payment::where('id', $bo->id)->update([
                                'server_response'=>$response,
                                'status'=>1,
                            ]);
                            $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                            $ph = $request->number;

                            $receiver = encription::decryptdata($user->email);
                            $admin = 'info@renomobilemoney.com';


                            Mail::to($receiver)->send(new Emailtrans($bo));
                            Mail::to($admin)->send(new Emailtrans($bo));
                            $username=encription::decryptdata($user->username);
                            $name="Airtime";
                            $body=$username.' purchase '.$name;
                            $this->reproduct($username, "User AirtimePurchase", $body);
                            $this->reproduct1($username, "User AirtimePurchase", $body);
                            $this->reproduct2($username, "User AirtimePurchase", $body);

                            $com=$wallet->balance+$comission;
                            $wallet->balance=$com;
                            $wallet->save();

                            $parise=$comission."₦ Commission Is added to your wallet balance";
                            Alert::success('success', $am.' ' .$ph.' & '.$parise);
//                    $msg=$am.' ' .$ph.' & '.$parise;
//                    Alert::image('Success..',$msg,'https://renomobilemoney.com/nov.jpeg','200','200', 'Image Alt');

                            return redirect()->route('viewpdf', $bo->id);
                        } elseif ($success == 0) {
//                            $zo = $wallet->balance + $request->amount;
//                            $wallet->balance = $zo;
//                            $wallet->save();

//                    $name = $bt->plan;
                            $am = "NGN $request->amount Was Refunded To Your Wallet";
                            $ph = ", Transaction fail";

                            Alert::error('error', $am.' ' .$ph);
                            return redirect()->route('viewpdf', $bo->id);
                        }
                    }

                }
                $bo = bill_payment::create([
                    'username' => $user->username,
                    'product' => $request->id.'Airtime',
                    'amount' => $request->amount,
                    'server_response' => 0,
                    'status' => 0,
                    'number' => $request->number,
                    'paymentmethod'=>'wallet',
                    'transactionid' => $request->refid,
                    'discountamount' => 0,
                    'fbalance'=>$fbalance,
                    'balance'=>$gt,
                ]);
                $comiS=Comission::create([
                    'username'=>Auth::user()->username,
                    'amount'=>$comission,
                ]);
                $bo['name']=encription::decryptdata($user->name);
                $bo['email']=encription::decryptdata(Auth::user()->email);

                $resellerURL = 'https://integration.mcd.5starcompany.com.ng/api/reseller/';
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
                $data = json_decode($response, true);
                $success = $data["success"];
                $tran1 = $data["discountAmount"];
                if ($success == 1) {
//                    $bo->server_response=$response;
//                    $bo->status=1;
//                    $bo->save();
                    $update=bill_payment::where('id', $bo->id)->update([
                        'server_response'=>$response,
                        'status'=>1,
                    ]);
                    $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                    $ph = $request->number;

                    $receiver = encription::decryptdata($user->email);
                    $admin = 'info@renomobilemoney.com';


                    Mail::to($receiver)->send(new Emailtrans($bo));
                    Mail::to($admin)->send(new Emailtrans($bo));
                    $username=encription::decryptdata($user->username);
                    $name="Airtime";
                    $body=$username.' purchase '.$name;
                    $this->reproduct($username, "User AirtimePurchase", $body);
                    $this->reproduct1($username, "User AirtimePurchase", $body);
                    $this->reproduct2($username, "User AirtimePurchase", $body);

                    $com=$wallet->balance+$comission;
                    $wallet->balance=$com;
                    $wallet->save();

                    $parise=$comission."₦ Commission Is added to your wallet balance";
                    Alert::success('success', $am.' ' .$ph.' & '.$parise);
//                    $msg=$am.' ' .$ph.' & '.$parise;
//                    Alert::image('Success..',$msg,'https://renomobilemoney.com/nov.jpeg','200','200', 'Image Alt');

                    return redirect()->route('viewpdf', $bo->id);
                } elseif ($success == 0) {
//                    $zo = $wallet->balance + $request->amount;
//                    $wallet->balance = $zo;
//                    $wallet->save();

//                    $name = $bt->plan;
                    $am = "NGN $request->amount Was Refunded To Your Wallet";
                    $ph = ", Transaction fail";

                    Alert::error('error', $am.' ' .$ph);
                    return redirect()->route('viewpdf', $bo->id);
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
            return redirect('dashboard');


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
                Mail::to($receiver)->send(new Emailtrans($bo));
                Mail::to($admin)->send(new Emailtrans($bo));
                $username=encription::decryptdata($user->username);
                $body=$username.' purchase '.$name;
                $this->reproduct($username, "User DataPurchase", $body);

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
    public  function reproduct($username, $title, $body)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "to": "/topics/Adeolu23",
    "notification": {
        "body": "'.$body.'",
        "title": "'.$title.'"
                "image": "https://renomobilemoney.com/images/bn.jpeg"

    }
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer AAAA0VPmumc:APA91bFO0BZ1BL5bGsBIFW2JGE3SZzC60y-Hrqg2UgVlgeYfj7_kIawa7W1Vz0LMTVhhyC1uy4dsSGAU2oe87HzR27PInPhLlDlWKOS5buvaejdQl2O2lWe9Ewts09GiRcmJEi3LnkzB',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        dd($response);
//        echo $response;
    }
    public  function reproduct1($username, $title, $body)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "to": "/topics/Izormor2019",
    "notification": {
        "body": "'.$body.'",
        "title": "'.$title.'"
                "image": "https://renomobilemoney.com/images/bn.jpeg"

    }
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer AAAA0VPmumc:APA91bFO0BZ1BL5bGsBIFW2JGE3SZzC60y-Hrqg2UgVlgeYfj7_kIawa7W1Vz0LMTVhhyC1uy4dsSGAU2oe87HzR27PInPhLlDlWKOS5buvaejdQl2O2lWe9Ewts09GiRcmJEi3LnkzB',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        dd($response);
//        echo $response;
    }
    public  function reproduct2($username, $title, $body)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "to": "/topics/'.$username.'",
    "notification": {
        "body": "'.$body.'",
        "title": "'.$title.'"
                "image": "https://renomobilemoney.com/images/bn.jpeg"

    }
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer AAAA0VPmumc:APA91bFO0BZ1BL5bGsBIFW2JGE3SZzC60y-Hrqg2UgVlgeYfj7_kIawa7W1Vz0LMTVhhyC1uy4dsSGAU2oe87HzR27PInPhLlDlWKOS5buvaejdQl2O2lWe9Ewts09GiRcmJEi3LnkzB',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        dd($response);
//        echo $response;
    }

}
