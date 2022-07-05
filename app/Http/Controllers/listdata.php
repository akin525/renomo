<?php

namespace App\Http\Controllers;
use App\Models\big;
use App\Models\data;
use Illuminate\Http\Request;


class listdata
{
public function list(Request $request)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.honourworld.com.ng/api/v1/get/data/plans',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer sk_live_9a55cd84-8ad7-46d9-9136-c5962858f753',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

    $data = json_decode($response, true);

//return $success;
foreach ($data as $plan){
    $success =$plan["network"];
    $planid = $plan["planId"];
    $price= $plan['price'];
    $allowance=$plan['allowance'];
    $validity =$plan['validity'];
    $insert= big::create([
        'plan_id' =>$planid,
        'network' =>$success,
        'plan' =>$allowance.$validity,
        'code' =>$planid,
        'amount'=>$price,
        'tamount'=>$price,
        'ramount'=>$price,
        'cat_id'=>$planid,
    ]);
}

//    return $product;

//    return view('pam', compact('product'));


}
public function lis()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.honourworld.com.ng/api/v1/set/webhook/url',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
    "url" : "https://mobile.primedata.com.ng/api/honor"
}',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer {{Token}}',
            'Content-Type: application/json',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

}
}
