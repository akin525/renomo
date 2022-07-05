<?php

namespace app\Http\Controllers\Api;
use App\Mail\Emailfund;
use App\Mail\Emailotp;
use App\Models\bo;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use App\Models\User;
use App\Models\wallet;
use App\Models\deposit;
use Illuminate\Support\Facades\Auth;

class FundController

{
    public function fund(Request  $request)
    {
        $apikey = $request->header('apikey');
        $user = User::where('apikey',$apikey)->first();
        if ($user) {
            $wallet1 = wallet::where('username', $user->username)->get();
            foreach ($wallet1 as $wallet){

            }
            $data2 = setting::get();
            $fund = deposit::where('username', $user->username)->get();

            return response()->json([
                'data2' => $data2, 'fund' => $fund, 'wallet' => $wallet,
                'user' => $user,
            ], 200);
        }
        return response()->json([
            'message' => 'You are not allowed to access',
        ], 200);


    }

        public function tran(Request $request, $reference)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
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
//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0)

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
//             echo $response;
        }
//        return $response;
        $data=json_decode($response, true);
        $amount=$data["data"]["amount"]/100;
        $auth=$data["data"]["authorization"]["authorization_code"];
// echo $auth;

            $apikey = $request->header('apikey');
            $user = User::where('apikey',$apikey)->first();
            if ($user) {
            $wallet = wallet::where('username', $user->username)->first();
        $pt=$wallet->balance;

            $depo = deposit::where('payment_ref', $reference)->first();
            if (isset($depo)) {
                return response()->json([
                    'message' => 'Duplicate Transaction',
                    'user' => $user,
                ], 200);

            } else {

                $gt = $amount + $pt;
                $deposit = deposit::create([
                    'username' => $user->username,
                    'payment_ref' =>"Api". $reference,
                    'amount' => $amount,
                    'iwallet' => $pt,
                    'fwallet' => $gt,
                ]);
                $wallet->balance = $gt;
                $wallet->save();

              $receiver= $user->email;
                Mail::to($receiver)->send(new Emailfund($deposit ));

                return response()->json([
                    'message' => "You are not allowed to access",
                ], 200);
            }
        }

    }
}
