<?php


namespace App\Http\Controllers\admin;


use App\Console\encription;
use App\Http\Controllers\Controller;
use App\Mail\Emailclon;
use App\Models\safe_lock;
use App\Models\User;
use App\Models\wallet;
use App\Models\wi;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class CronjobController extends Controller
{

    public function stopcronjob($request)
    {
        $job=safe_lock::where('id', $request)->first();
        $username=$job["username"];
        $balance=$job["balance"];

        $in=wi::create([
            'username'=>$username,
            'amount'=>$balance,
        ]);
        $kin=$job['balance'] - $balance;
        $job->balance=$kin;
        $job->status=0;
        $job->save();
        $wallet=wallet::where('username', $username)->first();
        $wa=$wallet->balance + $balance;
        $wallet->balance=$wa;
        $wallet->save();

        $userp=User::where('username', $username)->first();
            $receiver = encription::decryptdata($userp->email);
            $admin = 'info@renomobilemoney.com';


            Mail::to($receiver)->send(new Emailclon($in));
            Mail::to($admin)->send(new Emailclon($in));
            $msg="Safelock has been terminate successfully";
            Alert::success('Done', $msg);
        return back();
    }
}
