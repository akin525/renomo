<?php

namespace App\Http\Controllers;

use App\Console\encription;
use App\Models\bill_payment;
use App\Models\data;
use App\Models\neco;
use App\Models\server;
use App\Models\User;
use App\Models\waec;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RducationController
{
public function indexw()
{
    $waec=data::where('network', 'WAEC')->first();
    $wa=waec::where('username', Auth::user()->username)->get();
return view('waec', compact('waec', 'wa'));

}
public function indexn()
{
    $neco=data::where('network', 'NECO')->first();
    $ne=neco::where('username', Auth::user()->username)->get();

    return view('neco', compact('neco', 'ne'));

}
public function waec(Request $request)
{
$request->validate([
    'value'=>'required',
    'amount'=>'required',
]);
    $user = User::find($request->user()->id);
    $wallet = wallet::where('username', $user->username)->first();
    $serve = server::where('status', '1')->first();
    $product=data::where('network', 'WAEC')->first();

    if ($user->apikey == '') {
        $amount = $product->tamount;
    } elseif ($user != '') {
        $amount = $product->ramount;
    }

    if ($wallet->balance < $amount) {
        $mg = "You Cant Make Purchase Above" . "NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

        Alert::error('error', $mg);
        return redirect(route('dashboard'))
            ->with('error', $mg);

    }
    if ($request->amount < 0) {

        $mg = "error transaction";
        Alert::error('error', $mg);
        return redirect(route('dashboard'))
            ->with('error', $mg);

    }
    $bo = bill_payment::where('transactionid', $request->id)->first();
    if (isset($bo)) {
        $mg = "duplicate transaction";
        Alert::success('Success', $mg);
        return redirect(route('dashboard'))
            ->with('error', $mg);

    } else {

        $user = User::find($request->user()->id);
//                $bt = data::where("id", $request->productid)->first();
        $wallet = wallet::where('username', $user->username)->first();


        $gt = $wallet->balance - $request->amount;


        $wallet->balance = $gt;
        $wallet->save();
        $bo = bill_payment::create([
            'username' => $user->username,
            'product' => $product->network ,
            'amount' => $request->amount,
            'server_response' => 'ur fault',
            'status' => 1,
            'number' => $request->number,
            'transactionid' => $request->id,
            'discountamount'=>0,
            'paymentmethod'=> 'wallet',
            'balance'=>$gt,
        ]);
        $bo['name']=encription::decryptdata($user->name);
        $resellerURL = 'https://app2.mcd.5starcompany.com.ng/api/reseller/';
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
            CURLOPT_POSTFIELDS => array('service' => 'result_checker','coded' => 'WAEC','quantity' => $request->value,'phone' => encription::decryptdata($user->phone)),

            CURLOPT_HTTPHEADER => array(
                'Authorization: mcd_key_75rq4][oyfu545eyuriup1q2yue4poxe3jfd'
            )));


        $response = curl_exec($curl);

        curl_close($curl);
//                echo $response;
        $data = json_decode($response, true);
        $success = $data["success"];

        if ($success==1) {
            $ref=$data['ref'];
            $token=$data['token'];
            $token1=json_decode($token, true);
//return $token1;
            foreach ($token1 as $to){

                $insert=waec::create([
                    'username'=>$user->username,
                    'seria'=>$to['serial_number'],
                    'pin'=>$to['pin'],
                    'ref'=>$ref,
                ]);
            }
            $mg='Waec Checker Successful Generated, kindly check your pin';
            Alert::success('Successful',$mg );
            return redirect('waec')->with('success', $mg);

        }elseif($success==0){

            Alert::error('Fail', $response);
            return redirect('waec')->with('error', $response);
        }
return $response;
    }

}
public function neco(Request $request)
{
    $request->validate([
        'value'=>'required',
        'amount'=>'required',
    ]);
    $user = User::find($request->user()->id);
    $wallet = wallet::where('username', $user->username)->first();
    $serve = server::where('status', '1')->first();
    $product=data::where('network', 'NECO')->first();

    if ($user->apikey == '') {
        $amount = $product->tamount;
    } elseif ($user != '') {
        $amount = $product->ramount;
    }

    if ($wallet->balance < $amount) {
        $mg = "You Cant Make Purchase Above" . "NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

        Alert::error('error', $mg);
        return redirect(route('dashboard'))
            ->with('error', $mg);

    }
    if ($request->amount < 0) {

        $mg = "error transaction";
        Alert::error('error', $mg);
        return redirect(route('dashboard'))
            ->with('error', $mg);

    }
    $bo = bill_payment::where('transactionid', $request->id)->first();
    if (isset($bo)) {
        $mg = "duplicate transaction";
        Alert::success('Success', $mg);
        return redirect(route('dashboard'))
            ->with('error', $mg);

    } else {

        $user = User::find($request->user()->id);
//                $bt = data::where("id", $request->productid)->first();
        $wallet = wallet::where('username', $user->username)->first();


        $gt = $wallet->balance - $request->amount;


        $wallet->balance = $gt;
        $wallet->save();
        $bo = bill_payment::create([
            'username' => $user->username,
            'product' => $product->network ,
            'amount' => $request->amount,
            'server_response' => 'ur fault',
            'status' => 1,
            'number' => $request->number,
            'transactionid' => $request->id,
            'discountamount'=>0,
            'paymentmethod'=> 'wallet',
            'balance'=>$gt,
        ]);
        $bo['name']=encription::decryptdata($user->name);
        $resellerURL = 'https://app2.mcd.5starcompany.com.ng/api/reseller/';
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
            CURLOPT_POSTFIELDS => array('service' => 'result_checker','coded' => 'NECO','quantity' => $request->value,'phone' => encription::decryptdata($user->phone)),

            CURLOPT_HTTPHEADER => array(
                'Authorization: mcd_key_75rq4][oyfu545eyuriup1q2yue4poxe3jfd'
            )));


        $response = curl_exec($curl);

        curl_close($curl);
//                echo $response;
        $data = json_decode($response, true);
        $success = $data["success"];

        if ($success==1) {
            $ref=$data['ref'];
            $token=$data['token'];
            $token1=json_decode($token, true);
//return $token1;
            foreach ($token1 as $to){

                $insert=neco::create([
                    'username'=>$user->username,
                    'pin'=>$to['pin'],
                    'ref'=>$ref,
                ]);
            }
            $mg='Waec Checker Successful Generated, kindly check your pin';
            Alert::success('Successful',$mg );
            return redirect('neco')->with('success', $mg);

        }elseif($success==0){

            Alert::error('Fail', $response);
            return redirect('neco')->with('error', $response);
        }
        return $response;
    }
}
}

