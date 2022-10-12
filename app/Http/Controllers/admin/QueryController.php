<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
function queryindex()
{
    $sum=deposit::sum('amount');

    return view('admin/depodate', compact('sum'));
}
function querydeposi(Request $request)
{
    $request->validate([
        'from'=>'required',
        'to'=>'required',
    ]);

    $deposit=DB::table('deposits')
        ->whereBetween('date', [$request->from, $request->to])->get();
    $sum=deposit::sum('amount');
    $sumdate=DB::table('deposits')
        ->whereBetween('date', [$request->from, $request->to])->sum('amount');

    return view('admin/depodate', ['sum' => $sum, 'sumdate'=>$sumdate, 'deposit'=>$deposit, 'result'=>true]);


}
}
