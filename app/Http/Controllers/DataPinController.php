<?php

namespace App\Http\Controllers;

use App\Console\encription;
use App\Mail\Emailtrans;
use App\Models\bill_payment;
use App\Models\data;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class DataPinController extends Controller
{

    function dataindex()
    {
        $product = data::where('network', 'data_pin')->first();

        return view('datapin', compact('product'));
    }

    function processdatapin(Request $request)
    {
        $request->validate([

            'productid'=>'required'
        ]);
        $user = User::find($request->user()->id);
        $wallet = wallet::where('username', $user->username)->first();
        $product = data::where('network', $request->productid)->first();
        if ($user->apikey == '') {
            $amount = $product->tamount;
        } elseif ($user != '') {
            $amount = $product->ramount;
        }
//        if (Auth::user()->bvn==NULL){
//            Alert::warning('Update', 'Please Kindly Update your profile including your bvn for account two & to continue');
//            return redirect()->intended('myaccount')
//                ->with('info', 'Please Kindly Update your profile including your bvn for account two');
//        }
        if ($wallet->balance < $amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

            Alert::error('error', $mg);
            return back();

        }
        if ($request->amount < 0) {

            $mg = "error transaction";
            Alert::error('error', $mg);
            return back();

        }
        $bo = bill_payment::where('transactionid', $request->refid)->first();
        if (isset($bo)) {
            $mg = "duplicate transaction";
            Alert::success('Success', $mg);
            return back();

        } else {
            $fbalance=$wallet->balance;

            $gt = $wallet->balance - $amount;
            $wallet->balance = $gt;
            $wallet->save();

            $bo['email'] = encription::decryptdata(Auth::user()->email);

            $bo['name'] = encription::decryptdata($user->name);


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://integration.mcd.5starcompany.com.ng/api/reseller/pay',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('service' => 'data_pin', 'coded' => $product->code, 'quantity' => '1'),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: mcd_key_75rq4][oyfu545eyuriup1q2yue4poxe3jfd'
                ),
            ));


            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

            $data = json_decode($response, true);
            $success = $data["success"];

            if ($success=='1'){

                $bo =bill_payment::create([
                    'username' => $user->username,
                    'product' => $product->plan,
                    'amount' => $product->amount,
                    'server_response' => $response,
                    'status' => $success,
                    'number' => 'Any Number',
                    'transactionid' => $request->refid,
                    'discountamount' => $data["discountAmount"],
                    'token'=>$data['token'],
                    'paymentmethod'=>'wallet',
                    'fbalance'=>$fbalance,
                    'balance'=>$gt,
                ]);

                $name = $product->plan;
                $am = $product->network."was Successful";
                $ph = "| Token:".$data['token'];

                $receiver = encription::decryptdata($user->email);
                $admin = 'info@renomobilemoney.com';

                Mail::to($receiver)->send(new Emailtrans($bo));
                Mail::to($admin)->send(new Emailtrans($bo));
                Alert::success('success', $am.' ' .$ph);
                return redirect()->route('viewpdf', $bo->id);

            }
        }


    }

}
