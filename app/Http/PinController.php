<?php

namespace App\Http;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PinController extends Controller
{

    function createpin()
    {
        return view('cpin');
    }
    function pinsave(Request $request)
    {
        $request->validate([
            'pin'=>['required', 'numeric',  'min:4'],
            'pin1'=>['required', 'numeric',  'min:4'],
        ]);

        if ($request->pin != $request->pin1){
            $msg="Both pin does not match";
            Alert::error('Ooops..', $msg);
            return back();
        }
        if ($request->pin == $request->pin1) {
            $user = User::where('username', Auth::user()->username)->first();
            $user->pin = $request->pin;
            $user->save();

            $msg = "Transaction Pin successfully Created";
            Alert::success('Done', $msg);
            return redirect('myaccount');
        }
    }
}
