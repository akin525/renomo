<?php

namespace App\Http\Controllers;

use App\Models\bill_payment;
use App\Models\deposit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class verify
{
function verifypurchase(Request $request)
{
    $poo=bill_payment::where('transactionid', $request->refid)->first();
    if (!isset($poo)){
        $poo="";
        return response()->json('Transaction not found', Response::HTTP_BAD_REQUEST);
//        return redirect('verifybill')->with('error', 'Transaction not found');

    }else{
//        return $poo;
//        return view('check',['check'=>$poo, 'result'=>true]);
        return response()->json([
            'status'=>'1',
            'message' => $poo->server_response,
        ]);
    }

}
function verifydeposit(Request $request)
{
    $poo=deposit::where('payment_ref', $request->refid)->first();
    if (!isset($poo)){
        return response()->json('Transaction not found', Response::HTTP_BAD_REQUEST);

    }else{
//        return view('check1',['check'=>$poo, 'result'=>true]);
        return response()->json([
            'status'=>'1',
            'message' => $poo,
        ]);
    }

}
}
