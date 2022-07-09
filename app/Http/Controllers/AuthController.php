<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use App\Console\encription;
use App\Mail\login;
use App\Models\airtimecon;
use App\Models\big;
use App\Models\bill_payment;
use App\Models\charge;
use App\Models\charp;
use App\Mail\Emailpass;
use App\Models\Messages;
use App\Models\refer;
use App\Models\safe_lock;
use App\Models\server;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\wallet;
use App\Models\bo;
use App\Models\data;
use App\Models\deposit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController
{
    public function landing()
    {
        $mtn=data::where('network', 'mtn-data')->limit(7)->get();
        $glo=data::where('network', 'glo-data')->limit(7)->get();
        $eti=data::where('network', 'etisalat-data')->limit(7)->get();
        $airtel=data::where('network', 'airtel-data')->limit(7)->get();
Alert::info('Renomobilemoney', 'Data Refill | Airtime | Cable TV | Electricity Subscription');
        return view("home", compact("mtn", "glo", "eti", "airtel"));
    }
public function pass(Request $request)
{
    $request->validate([
        'email' => 'required',
    ]);

    $user = User::where('email', encription::encryptdata($request->email))->first();

    if (!isset($user)){
        Alert::error('Error', 'Email not found in our system');
        return back();

    }elseif ($user->email ==  encription::encryptdata($request->email)){
        $new['pass']= uniqid('Pass',true);

        $user->password=$new['pass'];
        $user->save();

        $admin= 'info@renomobilemoney.com';
$new['user']=encription::decryptdata($user->username);

        $receiver= $request->email;
        Mail::to($receiver)->send(new Emailpass($new));
        Mail::to($admin)->send(new Emailpass($new ));
Alert::success('Success', 'New Password has been sent to your email');
        return back();
    }
}
    public function cus(Request $request)
    {
        if (Auth()->user()) {
            return redirect(route('dashboard'))
                ->withSuccess('Signed in');

        }else{
            return redirect(route('log'));
        }
    }
    public function customLogin(Request $request)
    {


        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', encription::encryptdata($request->username))
            ->where('password', $request->password)
            ->first();

        if(!isset($user)){
            Alert::error('Credentials does not match', 'Kindly check your password & username');
            return back();
        }else {

            Auth::login($user);
//            $admin = 'info@renomobilemoney.com';
            $user = User::where('username', encription::encryptdata($request->username))->first();
            $login = encription::decryptdata($user->name);
            $receiver = encription::decryptdata($user->email);
            Mail::to($receiver)->send(new login($login));
//            Mail::to($admin)->send(new login($login));

            Alert::success('Dashboard', 'Login Successfully');
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }


    }
    public function dashboard(Request $request)
    {

            $user = User::where('username', Auth::user()->username)->first();
        $username=$user->username;

        $me = Messages::where('status', 1)->first();
            $refer = refer::where('username', $user->username)->get();
            $totalrefer = 0;
            foreach ($refer as $de){
                $totalrefer += $de->amount;

            }
            $count = refer::where('username',$user->username)->count();

            $wallet = wallet::where('username', $user->username)->get();
            $wallet1 = wallet::where('username', $user->username)->first();
            $deposite = deposit::where('username', $user->username)->get();
            $totaldeposite = 0;
            foreach ($deposite as $depo){
                $totaldeposite += $depo->amount;

            }
            $bil2 = bill_payment::where('username', $user->username)->get();
            $bill = 0;
            foreach ($bil2 as $bill1){
                $bill += $bill1->amount;

            }
            $lock=safe_lock::where('username',$user->username)
                ->where('status', '1')->sum('balance');
        $columnChartModel =
            (new ColumnChartModel())
                ->setTitle('Expenses by Type')
                ->addColumn('Wallet', $wallet1->balance, '#90cdf4')
                ->addColumn('Deposit', $totaldeposite, '#28a745')
                ->addColumn('Purchase', $bill, '#90cdf4')
        ;
        $pieChartModel=(new ColumnChartModel())
            ->setTitle('Expenses by Type')
            ->addColumn('Food', 100, '#f6ad55')
            ->addColumn('Shopping', 200, '#fc8181')
            ->addColumn('Travel', 300, '#90cdf4')
        ;
            return  view('dashboard', compact('username', "user", 'wallet', 'totaldeposite', 'me',  'bil2', 'bill', 'totalrefer',  'columnChartModel', 'pieChartModel',   'count', 'lock'));

    }
    public function refer(Request $request)
    {

            $user = User::find($request->user()->id);
            $username=encription::decryptdata($user->username);
            $refer = refer::where('username', $user->username)->first();

            $refers = refer::where('username', $user->username)->get();
            $totalrefer = 0;
            foreach ($refers as $depo){
                $totalrefer+= $depo->amount;

            }
//            return $username;

            return  view('referal', compact('username', 'refers', 'refer', 'totalrefer'));

    }
    public function select(Request  $request)
    {
        $serve = server::where('status', '1')->first();

            $user = User::find($request->user()->id);


            return view('select', compact('user', 'serve'));
       }
    public function select1(Request  $request)
    {
        $serve = server::where('status', '1')->first();

            $user = User::find($request->user()->id);


            return view('select1', compact('user', 'serve'));
         }
    public function buydata(Request  $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $serve = server::where('status', '1')->first();

        if ($serve->name == 'mcd') {
            $user = User::find($request->user()->id);
            $data = data::where(['status' => 1])->where('network', $request->id)->get();


            return view('buydata', compact('user', 'data'));
        } elseif ($serve->name == 'honorworld') {
            $user = User::find($request->user()->id);
            $data= big::where('status', '1')->where('network', $request->id)->get();
//return $data;
            return view('buydata', compact('user', 'data'));

        }
       }
    public function redata(Request  $request)
    {

        $request->validate([
            'id' => 'required',
        ]);
        $daterserver = new DataserverController();
        $serve = server::where('status', '1')->first();
//return $request->id;
        if ($serve->name == 'mcd') {
            $user = User::find($request->user()->id);
            $data = data::where(['status' => 1])->where('network', $request->id)->get();

//return $data;
            return view('redata', compact('user', 'data'));
        } elseif ($serve->name == 'honorworld') {
            $user = User::find($request->user()->id);
            $data= big::where('status', '1')->where('network', $request->id)->get();
//return $data;
            return view('redata', compact('user', 'data'));

        }
       }
    public function pre(Request $request)


    {
        $request->validate([
            'id' => 'required',
        ]);
        if(Auth::check()){
            $user = User::find($request->user()->id);
            $data = data::where('id',$request->id )->get();

            return view('pre', compact('user', 'data'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function airtime(Request  $request)
    {
        $con=DB::table('airtimecons')->where('status', '=', '1')->first();
        $se=$con->server;
        if ($se == 'MCD') {
            $user = User::find($request->user()->id);
            $data = data::where('plan_id', "airtime")->get();
            $wallet = wallet::where('username', $user->username)->first();

            return view('airtime', compact('user', 'data', 'wallet'));
        } elseif ($se == 'Honor'){
            return view('airtime1');

        }
    }

    public function invoice(Request  $request)
    {
        if(Auth::check()){
            $user = User::find($request->user()->id);
            $bill = bill_payment::where('username', $user->username)->get();


            return view('invoice', compact('user', 'bill'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function charges(Request  $request)
    {
        if(Auth::check()){
            $user = User::find($request->user()->id);
            $bill = charge::where('username', $request->user()->username)->get();


            return view('charges', compact('user', 'bill'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
