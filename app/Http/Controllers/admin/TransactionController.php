<?php

namespace App\Http\Controllers\admin;

use App\Console\encription;
use App\Models\bill_payment;
use App\Models\bo;
use App\Models\deposit;
use App\Models\safe_lock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController
{
public function index()
{
    $all=deposit::paginate(50);

    return view('admin/finddeposite', compact('all'));
}
    public function finduser(Request $request)
    {
        $input = $request->all();
        $user_name = encription::encryptdata($input['user_name']);
        $phoneno = $input['phoneno'];
        $reference = $input['reference'];
        $amount = $input['amount'];
        $date = $input['date'];

        // Instantiates a Query object
        $query = deposit::Where('username', 'LIKE', "%$user_name%")
            ->orWhere('payment_ref', 'LIKE', "%$reference%")
            ->orWhere('date', 'LIKE', "%$date%")
            ->OrderBy('id', 'desc')
            ->limit(1000)
            ->get();
        if(!$query){
            Alert::warning('Admin', 'details does not exist');
            return back();
        }
        $cquery = deposit::Where('username','LIKE',  "%$user_name%")
            ->orWhere('payment_ref', 'LIKE', "%$reference%")
            ->orWhere('date', 'LIKE', "%$date%")
            ->count();

        return view('admin/finddeposite', ['datas' => $query, 'count' => $cquery, 'result' => true]);
    }
    public function in(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');


        $data =deposit::orderBy('id', 'desc')->paginate(25);
        $tt = deposit::count();
        $ft = deposit::where([['date', 'like', Carbon::now()->format('Y-m-d') . '%']])->count();
        $st = deposit::where([['date', 'like', Carbon::now()->subDay()->format('Y-m-d') . '%']])->count();
        $rt = deposit::where([['date', 'like', Carbon::now()->subDays(2)->format('Y-m-d') . '%']])->count();
        $amount=deposit::sum('amount');
        $am=deposit::where([['date', 'LIKE', '%' . $today . '%']])->sum('amount');
        $am1=deposit::where([['date', 'like', '%'. Carbon::now()->subDay()->format('y-m-d'). '%']])->sum('amount');
        $am2=deposit::where([['date', 'like', '%'. Carbon::now()->subDays(2)->format('y-m-d'). '%']])->sum('amount');


        return view('admin/deposits', ['data' => $data,'amount'=>$amount, 'am'=>$am, 'am1'=>$am1, 'am2'=>$am2,  'tt' => $tt, 'ft' => $ft, 'st' => $st, 'rt' => $rt]);

    }
    public function bill()
    {
        $today = Carbon::now()->format('Y-m-d');


        $data =bill_payment::orderBy('id', 'desc')->paginate(25);
        $tt = bill_payment::count();
        $ft = bill_payment::where([['timestamp', 'like', Carbon::now()->format('Y-m-d') . '%']])->count();
        $st = bill_payment::where([['timestamp', 'like', Carbon::now()->subDay()->format('Y-m-d') . '%']])->count();
        $rt = bill_payment::where([['timestamp', 'like', Carbon::now()->subDays(2)->format('Y-m-d') . '%']])->count();
        $amount=bill_payment::sum('amount');
        $am=bill_payment::where([['timestamp', 'LIKE', '%' . $today . '%']])->sum('amount');
        $am1=bill_payment::where([['timestamp', 'like', '%'. Carbon::now()->subDay()->format('y-m-d'). '%']])->sum('amount');
        $am2=bill_payment::where([['timestamp', 'like', '%'. Carbon::now()->subDays(2)->format('y-m-d'). '%']])->sum('amount');

        return view('admin/bills', ['data' => $data,'amount'=>$amount, 'am'=>$am, 'am1'=>$am1, 'am2'=>$am2,  'tt' => $tt, 'ft' => $ft, 'st' => $st, 'rt' => $rt]);

    }
    public function pendingbill()
    {
        $today = Carbon::now()->format('Y-m-d');


        $data =bill_payment::where('status', 0)->get();
          return view('admin/pbills', ['data' => $data]);

    }

    public function getTransactions()
    {
        $transactions = deposit::selectRaw('DATE(date) as date, SUM(amount) as total_amount')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $dates = $transactions->pluck('date')->toArray();
        $amounts = $transactions->pluck('total_amount')->toArray();

        return response()->json([
            'dates' => $dates,
            'amounts' => $amounts,
        ]);
    }
    public function getTransactions1()
    {
        $transactions = bill_payment::selectRaw('DATE(timestamp) as date, SUM(amount) as total_amount')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $dates = $transactions->pluck('date')->toArray();
        $amounts = $transactions->pluck('total_amount')->toArray();

        return response()->json([
            'dates' => $dates,
            'amounts' => $amounts,
        ]);
    }
    public function showPieChart()
    {
        $today = Carbon::now()->format('Y-m-d');

        $totalUsers = User::count();
        $activeUsers =  User::where([['created_at', 'LIKE', $today . '%']])->count();

        return response()->json([
            'tusers' => $totalUsers,
            'nusers' => $activeUsers,
        ]);
    }
    public function lockPieChart()
    {
        $today = Carbon::now()->format('Y-m-d');

        $totalUsers = safe_lock::count();
        $activeUsers =  safe_lock::where([['status', '=', "1"]])->count();

        return response()->json([
            'tlock' => $totalUsers,
            'alock' => $activeUsers,
        ]);
    }
}
