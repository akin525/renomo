<?php

namespace App\Http\Controllers;

use App\Models\safe_lock;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
$insert=safe_lock::create([
   'username'=>$wallet->username,
   'tittle'=>$request->tittle,
   'balance'=>$request->amount,
   'date'=>$request->date,
   'transactionid'=>rand(111111111, 99999999),
   'paymentmethod'=>'wallet',
   'status'=>1,
]);
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
}
