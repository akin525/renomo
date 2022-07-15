<?php

namespace App\Http\Controllers;
use App\Console\encription;
use App\Mail\Emailcharges;
use App\Mail\Emailfund;
use App\Models\bo;
use App\Models\charp;
use App\Models\data;
use App\Models\deposit;
use App\Models\setting;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class VertualController
{
    public function vertual(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $wallet = wallet::where('username', $user->username)->first();

            $username=encription::decryptdata($user->username).rand(111, 999);
            $email=encription::decryptdata($user->email);
            $name=encription::decryptdata($user->name).rand(111, 999);
            $phone=encription::decryptdata($user->phone);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://app.mcd.5starcompany.com.ng/api/reseller/virtual-account',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('account_name' => $username, 'business_short_name' => 'RENO', 'uniqueid' => $name, 'email' => $email, 'phone' =>$phone, 'webhook_url' => 'https://renomobilemoney.com/api/run',),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: mcd_key_75rq4][oyfu545eyuriup1q2yue4poxe3jfd'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            return $response;
return $response;
//var_dump(array('account_name' => $name,'business_short_name' => 'RENO','uniqueid' => $username,'email' => $email,'phone' => '08146328645', 'webhook_url'=>'https://renomobilemoney.com/go/run.php'));
            $data = json_decode($response, true);
            $account = $data["data"]["account_name"];
            $number = $data["data"]["account_number"];
            $bank = $data["data"]["bank_name"];

            $wallet->account_number = $number;
            $wallet->account_name = $account;
            $wallet->save();

            return redirect("dashboard")->withSuccess('You are not allowed to access');


        }
    }
    public function run(Request $request)
    {
        //     if ($json = json_decode(file_get_contents("php://input"), true)) {
        //         print_r($json['ref']);
        // print_r($json['accountDetails']['accountName']);
        //         $data = $json;

        //     }
//$paid=$data["paymentStatus"];
        $refid=$request["ref"];
        $amount=$request["amount"];
        $no=$request["account_number"];
//  echo $amount;
// echo $bank;
//echo $acct;

        $wallet = wallet::where('account_number', $no)->first();
        $pt=$wallet->balance;

        if ($no == $wallet->account_number) {
            $depo = deposit::where('payment_ref', $refid)->first();
            $user = user::where('username', $wallet->username)->first();
            if (isset($depo)) {
                echo "payment refid the same";
            }else {

                $char = setting::first();
                $amount1 = $amount - $char->charges;


                $gt = $amount1 + $pt;
                $reference=$refid;

                $deposit = deposit::create([
                    'username' => $wallet->username,
                    'payment_ref' => $reference,
                    'amount' => $amount,
                    'iwallet' => $pt,
                    'fwallet' => $gt,
                ]);
                $charp = charp::create([
                    'username' => $wallet->username,
                    'payment_ref' => $reference,
                    'amount' => $char->charges,
                    'iwallet' => $pt,
                    'fwallet' => $gt,
                ]);


                $admin= 'admin@primedata.com.ng';

                $receiver= $user->email;
                Mail::to($receiver)->send(new Emailcharges($charp ));
                Mail::to($admin)->send(new Emailcharges($charp ));

                $wallet->balance = $gt;
                $wallet->save();
                $user = user::where('username', $wallet->username)->first();

                $receiver = $user->email;
                Mail::to($receiver)->send(new Emailfund($deposit));

            }


        }
    }

}
