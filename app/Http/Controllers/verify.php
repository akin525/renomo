<?php

namespace App\Http\Controllers;

use App\Models\bill_payment;
use App\Models\deposit;
use Illuminate\Http\Request;

class verify
{
function verifypurchase(Request $request)
{
    $poo=bill_payment::where('transactionid', $request->refid)->first();
    if (!isset($poo)){
        $poo="";
        return redirect('verifybill')->with('error', 'Transaction not found');

    }else{
//        return $poo;
        return view('check',['check'=>$poo, 'result'=>true]);
    }

}
function verifydeposit(Request $request)
{
    $poo=deposit::where('payment_ref', $request->refid)->first();
    if (!isset($poo)){

        return redirect('verifydeposit')->with('error', 'Transaction not found');

    }else{
        return view('check1',['check'=>$poo, 'result'=>true]);
    }

}
}
