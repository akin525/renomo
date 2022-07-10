<?php

namespace App\Http\Controllers;

use App\Console\encription;
use App\Mail\Emaillock;
use App\Mail\Emailpass;
use App\Models\safe_lock;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class SafelockController
{
public function safe(Request $request)
{
$request->validate([
    'username'=>'required',
    'amount'=>'required',
    'date'=>'required',
    'tittle'=>'required',
    'name'=>'required',
]);

$wallet=wallet::where('username', Auth::user()->username)->first();
    $user = User::where('username', Auth::user()->username)->first();

if ($wallet->balance < $request->amount) {
    $msg ="Insufficient Balance Kindly Fund Your Wallet And come back for safe-lock";
    Alert::error('error', $msg);
    return back();
}
    if ($request->amount < 0) {
        $msg ="Please Enter a valid amount";
        Alert::error('error', $msg);
        return back();
    }
    $gt = $wallet->balance - $request->amount;
$wallet->balance=$gt;
$wallet->save();
$input=safe_lock::create([
   'username'=>$wallet->username,
   'tittle'=>$request->tittle,
   'balance'=>$request->amount,
   'date'=>$request->date,
   'transactionid'=>rand(111111111, 99999999),
   'paymentmethod'=>'wallet',
   'status'=>1,
]);
    $admin= 'info@renomobilemoney.com';

    $receiver= encription::decryptdata($user->email);
    Mail::to($receiver)->send(new Emaillock($input));
    Mail::to($admin)->send(new Emaillock($input ));
    $msg ="Safe-lock created successfully";
    Alert::success('New Safelock', $msg);
    return redirect(route('allock'))
        ->with('success', 'good');
}
public  function index()
{
    $lock=safe_lock::where('username', Auth::user()->username)->orderBy('id', 'desc')->get();
    return view("allock", compact("lock"));
}
public function add($request)
{

    $safe=safe_lock::where('id', $request)->first();
//    Alert::info('Safelock', 'You can add to ur selected safelock anytime');
    return view("addlock", compact("safe"));
}
public function adlock(Request $request)
{
    $request->validate([
        'id'=>'required',
    ]);
    $wallet=wallet::where('username', Auth::user()->username)->first();
    $user = User::where('username', Auth::user()->username)->first();

    if ($wallet->balance < $request->amount) {
        $msg ="Insufficient Balance Kindly Fund Your Wallet And come back for safe-lock";
        Alert::error('error', $msg);
        return back();
    }
    if ($request->amount < 0) {
        $msg ="Please Enter a valid amount";
        Alert::error('error', $msg);
        return back();
    }

    $safe=safe_lock::where('id', $request->id)->first();
    $total=$safe->balance + $request->amount;
    $safe->balance=$total;
    $safe->save();
    $gt = $wallet->balance - $request->amount;
    $wallet->balance=$gt;
    $wallet->save();
    $msg ="You have successfully add NGN".$request->amount ." to ".$safe->tittle. " lock";
    Alert::success('New Safelock', $msg);
    return back();

}
}
