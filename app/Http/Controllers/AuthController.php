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
use App\Models\easy;
use App\Models\Giveaway;
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
use mysql_xdevapi\Exception;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController
{
    public function landing()
    {
        $mtn=data::where('network', 'mtn-data')->limit(7)->get();
        $glo=data::where('network', 'glo-data')->limit(7)->get();
        $eti=data::where('network', 'etisalat-data')->limit(7)->get();
        $airtel=data::where('network', 'airtel-data')->limit(7)->get();
        $me = Messages::where('status', 1)->first();
        Alert::image('Latest News', $me->message,'https://renomobilemoney.com/images/bn.jpeg','200','200', 'Image Alt');

//Alert::info('Renomobilemoney', 'Data Refill | Airtime | Cable TV | Electricity Subscription');
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
        if (Auth::user()){
            Alert::success('Dashboard', 'Login Successfully');
            return redirect()->intended('dashboard')
                ->with('success', 'Welcome back '.encription::decryptdata($user->name));
        }
        if(!isset($user)){
            Alert::error('Credentials does not match', 'Kindly check your password & username');
            return back();
        }else {

            Auth::login($user);
//            $admin = 'info@renomobilemoney.com';
            $user = User::where('username', encription::encryptdata($request->username))->first();
            $login = encription::decryptdata($user->name);
            $receiver = encription::decryptdata($user->email);
            try {
                Mail::to($receiver)->send(new login($login));
            }catch (Exception $ex){

            }
//            Mail::to($admin)->send(new login($login));
            // forever
//            cookie()->queue(cookie()->forever("username", $request->username));
            Alert::success('Dashboard', 'Login Successfully');
            return redirect()->intended('dashboard')
                ->with('success', 'Welcome back '.encription::decryptdata($user->name));
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
        // forever

        cookie()->queue(cookie()->forever("username", encription::decryptdata( $user->username)));
            $count = refer::where('username',$user->username)->count();

            $wallet = wallet::where('username', $user->username)->get();
            $wallet1 = wallet::where('username', $user->username)->first();
            $pam = deposit::where('username', $user->username)->latest()->limit(1)->get();
            $pam1 = deposit::where('username', $user->username)->latest()->limit(10)->get();
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

        $time = date("H");
        $timezone = date("e");
        if ($time < "12") {
            $greet="Good morning ☀️";
        } else
            if ($time >= "12" && $time < "17") {
                $greet="Good afternoon 🌞";
            } else
                if ($time >= "17" && $time < "19") {
                    $greet="Good evening 🌙";
                } else
                    if ($time >= "19") {
                        $greet="Good night 🌚";
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
        $give=Giveaway::where('status', 1)->get();
        $giveaway=Giveaway::where('status', 1)->count();
        if ($giveaway>0){
            Alert::image('Giveaway Time!!','Check Our Giveaway Page','https://renomobilemoney.com/give.jpg','200','200', 'Image Alt');

        }else{
//            Alert::image('Latest News!!',$me->message,'https://renomobilemoney.com/images/bn.jpeg','200','200', 'Image Alt');
        }
        $cdeposite=deposit::where('username', Auth::user()->username)->count();
        $cbill=bill_payment::where('username', Auth::user()->username)->count();
        $cgive=Giveaway::where('username', Auth::user()->username)->count();

        $all=$cdeposite+$cbill+$cgive;

            return  view('dashboard', compact('username', 'give', 'all', 'cbill', 'cgive', "user", 'greet','pam1', 'wallet', 'totaldeposite', 'me', 'cdeposite',  'bil2', 'bill', 'totalrefer',  'pam', 'pieChartModel',   'count', 'lock'))->with('success', 'Welcome back '.encription::decryptdata($user->name));

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
        if (isset($serve)) {
            $user = User::find($request->user()->id);


            return view('select', compact('user', 'serve'));
        } else {
            Alert::info('Server', 'Out of service, come back later');
            return redirect('dashboard');
        }
    }
    public function select1(Request  $request)
    {
        $serve = server::where('status', '1')->first();
        if (isset($serve)) {
            $user = User::find($request->user()->id);


            return view('select1', compact('user', 'serve'));
        }else {
            Alert::info('Server', 'Out of service, come back later');
            return redirect('dashboard');
        }
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

        }elseif ($serve->name == 'easyaccess') {
            $user = User::find($request->user()->id);
            $data= easy::where('status', '1')->where('network', $request->id)->get();
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

                return view('redata', compact('user', 'data'));

        } elseif ($serve->name == 'honorworld') {
            $user = User::find($request->user()->id);
            $data= big::where('status', '1')->where('network', $request->id)->get();
//return $data;
            return view('redata', compact('user', 'data'));

        }elseif ($serve->name == 'easyaccess') {
            $user = User::find($request->user()->id);
            $data= easy::where('status', '1')->where('network', $request->id)->get();
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
        if (isset($con)) {
            $se = $con->server;
        }else{
            $se=0;
        }
        if ($se == 'MCD') {
            $user = User::find($request->user()->id);
            $data = data::where('plan_id', "airtime")->get();
//            $wallet = wallet::where('username', $user->username)->first();

            return view('airtime', compact('user', 'data'));
        } elseif ($se == 'Honor'){
            return view('airtime1');

        }else {
            Alert::info('Server', 'Out of service, come back later');
            return redirect('dashboard');
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
