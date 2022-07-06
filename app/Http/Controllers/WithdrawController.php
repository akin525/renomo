<?php

namespace App\Http\Controllers;

use App\Models\withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
public function get(Request $request)
{
    $request->validate([
       'name'=>'required',
        'bank'=>'required',
        'number'=>'required',
    ]);

    $input=$request->all();
}
}
