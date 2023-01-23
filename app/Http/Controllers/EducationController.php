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

class EducationController
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
        $amount = $product->tamount *$request->value;
    } elseif ($user != '') {
        $amount = $product->ramount *$request->value;
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
        $resellerURL = 'https://integration.mcd.5starcompany.com.ng/api/reseller/';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccess.com.ng/api/waec_v2.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: 1e8396312a0a0ddaffad3d35740adca4", //replace this with your authorization_token
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
//                return $response;
        $data = json_decode($response, true);

        if ($data["success"]=="true") {
            $ref=$data['reference_no'];
            $token=$data['pin'];
                $insert=waec::create([
                    'username'=>$user->username,
                    'seria'=>"serial no from pin",
                    'pin'=>$token,
                    'ref'=>$ref,
                ]);

            $mg='Waec Checker Successful Generated, kindly check your pin';
            Alert::success('Successful',$mg );
            return redirect('waec')->with('success', $mg);

        }elseif($data["success"]=="false"){
            $zo = $wallet->balance + $amount;
            $wallet->balance = $zo;
            $wallet->save();

            Alert::error('Fail', $response);
            return redirect('waec')->with('error', $response);
        }
//return $response;
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
        $amount = $product->tamount *$request->value;
    } elseif ($user != '') {
        $amount = $product->ramount *$request->value;
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
        $resellerURL = 'https://integration.mcd.5starcompany.com.ng/api/reseller/';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccess.com.ng/api/neco_v2.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'no_of_pins' =>5,
            ),
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: 1e8396312a0a0ddaffad3d35740adca4", //replace this with your authorization_token
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
//        echo $response;
//                return $response;
        $data = json_decode($response, true);

        if ($data["success"]=="true") {
            $ref=$data['reference_no'];
            $token=$data['pin'];
            $token1=json_decode($token, true);
//return $token1;

                $insert=neco::create([
                    'username'=>$user->username,
                    'pin'=>$token,
                    'ref'=>$ref,
                ]);

            $mg='Waec Checker Successful Generated, kindly check your pin';
            Alert::success('Successful',$mg );
            return redirect('neco')->with('success', $mg);

        }elseif($data["success"]=="false"){
            $zo = $wallet->balance + $amount;
            $wallet->balance = $zo;
            $wallet->save();

            Alert::error('Fail', $response);
            return redirect('neco')->with('error', $response);
        }
        return $response;
    }
}
public function allneco()
{
    $neco=neco::all();
    return view('admin/neco', compact('neco'));
}
}

