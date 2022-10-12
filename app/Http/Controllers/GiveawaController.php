<?php

namespace App\Http\Controllers;

use App\Models\data;
use App\Models\Giveaway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiveawaController extends Controller
{
function giveaway()
{
    $give=Giveaway::where('username', Auth::user()->username)->first();
    $product=data::all();
    return view('giveaway', compact('give', 'product'));
}
function creategiveaway(Request $request)
{
    $request->validate([
        'name'=>'required',
        'product'=>'required',
        'amount'=>'required',

    ]);
}
}
