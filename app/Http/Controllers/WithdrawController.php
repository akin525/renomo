<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\wallet;
use App\Models\withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class WithdrawController
{
public function bank()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/bank",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_280c68e08f76233b476038f04d92896b4749eec3",
            "Cache-Control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
//    echo $response;
    }
    $data = json_decode($response, true);
    $success = $data["status"];
    $with=withdraw::where('username', Auth::user()->username)->get();

    return view("withdraw", compact("data", "with"));
}
public function verify(Request $request)
{
    $request->validate([
        'bank'=>'required',
        'number'=>'required',
    ]);

    $input=$request->all();

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://sandbox.monnify.com/api/v1/disbursements/account/validate?accountNumber=$request->number&bankCode=$request->bank",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization:  Basic TUtfVEVTVF9LUFoyQjJUQ1hLOkJERkJZUUtRSEVHR1NCOFJFODI3VlRGODhYVEJQVDJN",
            "Cache-Control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
//return $response;
    }

    $data = json_decode($response, true);
//$success = $data["status"];
    $tran = $data["responseBody"]["accountName"];
return view("witve", compact("request", "tran"));
}
public function sub(Request $request)
{
    $request->validate([
        'number'=>'required',
        'name'=>'required',
        'amount'=>'required',
    ]);
    $wallet=wallet::where('username', Auth::user()->username)->first();
    $user = User::where('username', Auth::user()->username)->first();

    if ($wallet->balance < $request->amount) {
        $msg ="Insufficient Balance ";
        Alert::error('error', $msg);
        return back();
    }
    if ($request->amount < 0) {
        $msg ="Please Enter a valid amount";
        Alert::error('error', $msg);
        return back();
    }

    $total=$wallet->balance - $request->amount;
    $wallet->balance=$total;
    $wallet->save();
    $insert=withdraw::create([
       'username'=>Auth::user()->username,
       'amount'=>$request['amount'],
        'bank'=>$request['bank'],
        'account_no'=>$request['number'],
        'name'=>$request['name'],
    ]);


    $mg="Your request has been received u will receive alert soon";
    Alert::success('Succcess', $mg);
    return redirect('withdraw');
}
}
