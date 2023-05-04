<?php

namespace App\Http\Controllers\admin;

use App\Console\encription;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\wallet;
use RealRashid\SweetAlert\Facades\Alert;

class RegenerateVirtualAccountController extends Controller
{
function regenrateaccount($request)
{
    $user=User::where('id', $request)->first();
    $wallet=wallet::where('username', $user->username)->first();

    $username=encription::decryptdata($user['username']).rand(111, 999);
    $email=encription::decryptdata($user['email']);
    $name=encription::decryptdata($user['name']);
    $phone=encription::decryptdata($user['phone']);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://integration.mcd.5starcompany.com.ng/api/reseller/virtual-account',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('account_name' =>  $name, 'business_short_name' => 'RENO', 'uniqueid' => $username, 'email' => $email, 'phone' => $phone, 'webhook_url' => 'https://renomobilemoney.com/api/run',),
        CURLOPT_HTTPHEADER => array(
            'Authorization: mcd_key_75rq4][oyfu545eyuriup1q2yue4poxe3jfd'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response, true);
    if ($data['success']==1){
        $account = $data["data"]["account_name"];
        $number = $data["data"]["account_number"];
        $bank = $data["data"]["bank_name"];

        $wallet->account_number=$number;
        $wallet->account_name=$account;
        $wallet->save();

        Alert::success('Success', 'Account Details Generated Successful');
        return back();
    }elseif ($data['success']==0){


        Alert::error('Oops', $response);
        return back();

    }
}
}
