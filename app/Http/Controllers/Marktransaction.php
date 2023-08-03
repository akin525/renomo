<?php

namespace App\Http\Controllers;

use App\Models\bill_payment;
use App\Models\wallet;
use RealRashid\SweetAlert\Facades\Alert;

class Marktransaction extends Controller
{

    function accepttransaction($request)
    {
        $goods=bill_payment::where('id',$request )->first();
        $update=1;

        $goods->status=$update;
        $goods->save();

        $msg="Transaction Approved";
        Alert::success('Done', $msg);
        return back();
    }

    public function reversetransaction($request)
    {
        $re=bill_payment::where('id', $request)->first();
        $wallet=wallet::where('username', $re->username)->first();

        $reverse=$wallet->balance + $re->amount;

        $wallet->balance=$reverse;
        $wallet->save();

        $re->delete();
        $msg="Transaction Successfully Reverse";
        Alert::success('Reverse', $msg);
        return back();
    }
}
