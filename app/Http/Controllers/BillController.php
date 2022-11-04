<?php
namespace App\Http\Controllers;
use App\Console\encription;
use App\Mail\Emailfund;
use App\Mail\Emailtrans;
use App\Models\big;
use App\Models\bill_payment;
use App\Models\bo;
use App\Models\data;
use App\Models\deposit;
use App\Models\profit;
use App\Models\profit1;
use App\Models\server;
use App\Models\setting;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{

    public function bill(Request $request)
    {
        $request->validate([
            'productid' => 'required',
        ]);
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $wallet = wallet::where('username', $user->username)->first();
            $serve = server::where('status', '1')->first();
            if ($serve->name == 'honorworld') {
                $product = big::where('id', $request->productid)->first();
            } elseif ($serve->name == 'mcd') {
                $product = data::where('id', $request->productid)->first();
            }

            if ($user->apikey == '') {
                $amount = $product->tamount;
            } elseif ($user != '') {
                $amount = $product->ramount;
            }

            if ($wallet->balance < $amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

//                Alert::error('error', $mg);
                Alert::image('Ooops..',$mg,'https://renomobilemoney.com/nov.jpeg','200','200', 'Image Alt');
                return redirect(route('invoice'))
                    ->with('error', $mg);

            }
            if ($request->amount < 0) {

                $mg = "error transaction";
//                Alert::error('error', $mg);
                Alert::image('Ooops..',$mg,'https://renomobilemoney.com/nov.jpeg','200','200', 'Image Alt');
                return redirect(route('invoice'))
                    ->with('error', $mg);

            }
            $bo = bill_payment::where('transactionid', $request->id)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction";
                Alert::success('Success', $mg);
                return redirect(route('invoice'))
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
                    'product' => $product->network . '|' . $product->plan,
                    'amount' => $request->amount,
                    'server_response' => 'ur fault',
                    'status' => 1,
                    'number' => $request->number,
                    'transactionid' => $request->id,
                    'discountamount'=>0,
                    'paymentmethod'=> 'wallet',
                    'balance'=>$gt,
                ]);
                $bo['email']=encription::decryptdata(Auth::user()->email);

                $bo['name']=encription::decryptdata($user->name);

                $object = json_decode($product);
                $object->number = $request->number;
                $json = json_encode($object);

                $daterserver = new DataserverController();
                $mcd = server::where('status', "1")->first();

                if ($mcd->name == "honorworld") {
                    $response = $daterserver->honourwordbill($object);
//return $response;
                    $data = json_decode($response, true);
                    $success = "";
                    if ($data['code'] == '200') {
                        $success = 1;
                        $ms = $data['message'];

//                    echo $success;

                        $po = $amount - $product->amount;



                        $profit = profit1::create([
                            'username' => $user->username,
                            'plan' => $product->network . '|' . $product->plan,
                            'amount' => $po,
                        ]);

//                        $name = $product->plan;
                        $am = "$product->plan  was successful delivered to";
                        $ph = $request->number;


                        $receiver = encription::decryptdata($user->email);
                        $admin = 'info@renomobilemoney.com';

//                        $admin2 = 'primedata18@gmail.com';

                        Mail::to($receiver)->send(new Emailtrans($bo));
                        Mail::to($admin)->send(new Emailtrans($bo));
//                        Mail::to($admin2)->send(new Emailtrans($bo));

                        Alert::success('success', $am.' ' .$ph);
                        return redirect(route('dashboard'))
                            ->with('success', $am.' ' .$ph);
                    } elseif ($data['code'] == '300') {
                        $success = 0;
                        $zo = $wallet->balance + $request->amount;
                        $wallet->balance = $zo;
                        $wallet->save();

                        $name = $product->plan;
                        $am = "NGN $request->amount Was Refunded To Your Wallet";
                        $ph = ", Transaction fail";

                        Alert::error('error', $am.' ' .$ph);
                        return redirect(route('dashboard'))
                            ->with('error', $am.' ' .$ph);
                    }
                } else if ($mcd->name == "mcd") {
                    $response = $daterserver->mcdbill($object);

                    $data = json_decode($response, true);

                    if (isset($data['success'])) {
                        $dis=$data['discountAmount'];
//                    echo $success;
                        $success = "1";
                        $po = $amount - $product->amount;



                        $profit = profit::create([
                            'username' => $user->username,
                            'plan' => $product->network . '|' . $product->plan,
                            'amount' => $po,
                        ]);

                        $name = $product->plan;
                        $am = "$product->plan  was successful delivered to";
                        $ph = $request->number;


                        $receiver = encription::decryptdata($user->email);
                        $admin = 'info@renomobilemoney.com';


                        Mail::to($receiver)->send(new Emailtrans($bo));
                        Mail::to($admin)->send(new Emailtrans($bo));
//                        Mail::to($admin2)->send(new Emailtrans($bo));

                        $username=encription::decryptdata($user->username);
                        $body=$username.' purchase '.$name;
                        $this->reproduct($username, "User DataPurchase", $body);
                        $this->reproduct1($username, "User DataPurchase", $body);
                        $this->reproduct2($username, "User DataPurchase", $body);

//                        Alert::success('success', $am.' ' .$ph);
                        $msg=$am.' ' .$ph;
                        Alert::image('Success..',$msg,'https://renomobilemoney.com/nov.jpeg','200','200', 'Image Alt');
                        return redirect(route('invoice'))
                            ->with('success', $am.' ' .$ph);
                    }elseif (!isset($data['success'])) {
                        $success = 0;
                        $zo = $wallet->balance + $request->amount;
                        $wallet->balance = $zo;
                        $wallet->save();

                        $name = $product->plan;
                        $am = "NGN $request->amount Was Refunded To Your Wallet";
                        $ph = ", Transaction fail";
                        Alert::error('error', $am.' ' .$ph);
                        return redirect(route('invoice'))
                            ->with('error', $am.' ' .$ph);
                    }

                }


//return $response;
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




