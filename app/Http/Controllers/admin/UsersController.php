<?php

namespace app\Http\Controllers\admin;

use App\Console\encription;
use App\Models\bill_payment;
use App\Models\bo;
use App\Models\charge;
use App\Models\charp;
use App\Models\deposit;
use App\Models\Messages;
use App\Models\refer;
use App\Models\server;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController
{
    public function index(Request $request)
    {
$u=User::get();
//        $users =DB::table('users')
//            ->join('wallets','users.username','=','users.username')
//            ->paginate(30);
        $users=User::with('parentData')->paginate(30);
        $wallet = DB::table('wallets')->orderBy('id', 'desc')->get();
$reseller=DB::table('users')->where("apikey", "!=", "")->count();
        $t_users = DB::table('users')->count();
        $f_users = DB::table('users')->where("role","=","")->count();

        $r_users = DB::table('refers')->where("username","!=","")->count();

        $a_users = DB::table('users')->where("role","=","users")->count();

//return $users;
        return view('admin/users', ['users' => $users, 'res'=>$reseller, 't_users'=>$t_users, 'wallet'=>$wallet, 'f_users'=>$f_users, 'r_users'=>$r_users,'a_users'=>$a_users]);

    }
    public function fin()
    {
        $user=User::get();
        return view('admin/finds', compact('user'));

    }
    public function finduser(Request $request){
        $input = $request->all();
        $user_name=encription::encryptdata($input['user_name']);
        $phoneno=encription::encryptdata($input['phoneno']);
        $status=$input['status'];
        $wallet=$input['wallet'];
        $email=encription::encryptdata($input['email']);
        $regdate=$input['regdate'];

        // Instantiates a Query object
        $query = User::Where('username', 'LIKE', "%$user_name%")->with('parentData')->limit(500)
            ->get();

        $cquery = User::Where('username', 'LIKE', "%$user_name%")->count();

        return view('admin/finds', ['users' => $query, 'count'=>$cquery, 'result'=>true]);
    }
    public function profile($username)
    {
//        $username=encription::encryptdata($usern);
        $ap = User::where('username', $username)->first();

        if(!$ap){
            Alert::warning('Admin', 'ser does not exist');
            return redirect('admin/finds');
        }
$wallet=wallet::where('username', $username)->first();
        $user =User::where('username', $username)->first();
        $sumtt = deposit::where('username', $ap->username)->sum('amount');
        $tt = deposit::where('username', $ap->username)->count();
        $td = deposit::where('username', $ap->username)->paginate(10);
        $v = DB::table('bill_payments')->where('username', $ap->username)->orderBy('id', 'desc')->paginate(25);
       $referrals = refer::where('username', $ap->usernamer)->get();
        $tat = bill_payment::where('username', $ap->username)->count();
        $sumbo = bill_payment::where('username', $ap->username)->sum('amount');
        $sumch = charge::where('username', $ap->username)->sum('amount');
        $charge = charge::where('username', $ap->username)->paginate(10);
        $cname=encription::decryptdata($user->name);
        $cphone=encription::decryptdata($user->phone);
        $cmail=encription::decryptdata($user->email);
//return $user;
        return view('admin/profile', ['user' => $ap, 'sumtt'=>$sumtt, 'charge'=>$charge,  'sumch'=>$sumch, 'sumbo'=>$sumbo, 'tt' => $tt, 'wallet'=>$wallet, 'td' => $td, 'cphone'=>$cphone, 'cname'=>$cname, 'cmail'=>$cmail,  'referrals' => $referrals, 'version' => $v,  'tat' =>$tat]);
    }
    public function server()
    {
        $server=server::get();

        return view('admin/server', compact('server'));
    }

    public function up(Request $request)
    {
        $server=server::where('id', $request->id)->first();
        if ($server->status==1)
        {
            $u="0";
        }else{
            $u="1";
        }

        $server->status=$u;
        $server->save();
        return redirect(url('admin/server'))
            ->with('status',' Server change successfully');

    }
    public function mes()
    {
        $message=Messages::where('status', 1)->first();

        return view('admin/noti', compact('message'));
    }

    public function me(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'message' => 'required',
        ]);
        $message=Messages::where('id', $request->id)->first();

        $message->message=$request->message;
        $message->save();
        Alert::success('Admin', 'Notification Change Successful');
        return redirect(url('admin/noti'));
    }
}
