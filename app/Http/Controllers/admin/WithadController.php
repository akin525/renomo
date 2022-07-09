<?php

namespace App\Http\Controllers\admin;

use App\Models\withdraw;
use RealRashid\SweetAlert\Facades\Alert;

class WithadController
{
public function index()
{
    $all=withdraw::orderBy('id', 'desc')->paginate(15);
    $total=withdraw::sum('amount');
    return view("admin/request", compact("all", "total"));
}
public function approve($request)
{
    $w=withdraw::where('id', $request)->first();
    $m=1;

    $w->status=$m;
    $w->save();
    $mg= "Withdraw request was approve successfully";
    Alert::success('Admin', $mg);
    return back();
}
    public function disapprove($request)
    {
        $w=withdraw::where('id', $request)->first();
        $m=2;

        $w->status=$m;
        $w->save();
        $mg= "Withdraw request was disapprove successfully";
        Alert::info('Admin', $mg);
        return back();
    }

}
