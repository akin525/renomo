<?php

namespace App\Http\Controllers;

use App\Models\bill_payment;
use App\Models\charp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController
{
    function yearly(Request $request)
    {
        if (!isset($request->date)) {
            $date = Carbon::now()->format("Y");
        } else {
            $date = Carbon::parse($request->date)->format("Y");
        }

        $data['data'] = bill_payment::where([['product', 'like', '%data%'], ['status', '=', '1'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['data_amount'] = bill_payment::where([['product', 'like', '%data%'], ['status', '=', '1'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');
        $data['airtime'] = bill_payment::where([['product', 'like', '%airtime%'], ['status', '=', '1'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['airtime_amount'] = bill_payment::where([['product', 'like', '%airtime%'], ['status', '=', '1'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');
        $data['tv'] = bill_payment::where([['product', 'like', '%tv%'], ['status', 'like', '1'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['tv_amount'] = bill_payment::where([['product', 'like', '%tv%'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');
        $data['electricity'] = bill_payment::where([['product', 'like', '%electricity%'], ['status', 'like', '1'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['electricity_amount'] = bill_payment::where([['product', 'like', '%electricity%'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');

        $data['te'] = 0;

        $data['date'] = $date;

        return view('admin/report_yearly', $data);
    }

    function monthly(Request $request)
    {
        if (!isset($request->date)) {
            $date = Carbon::now()->format("Y-m");
        } else {
            $date = Carbon::parse($request->date)->format("Y-m");
        }

        $data['data'] = bill_payment::where([['product', 'like', '%data%'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['data_amount'] = bill_payment::where([['product', 'like', '%data%'], ['status', '=', '1'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');
        $data['airtime'] = bill_payment::where([['product', 'like', '%airtime%'], ['status', '=', '1'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['airtime_amount'] = bill_payment::where([['product', 'like', '%airtime%'], ['status', '=', '1'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');
        $data['tv'] = bill_payment::where([['product', 'like', '%tv%'], ['status', 'like', '1'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['tv_amount'] = bill_payment::where([['product', 'like', '%tv%'], ['status', 'like', '1'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');
        $data['electricity'] = bill_payment::where([['product', 'like', '%electricity%'], ['status', 'like', '1'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['electricity_amount'] = bill_payment::where([['product', 'like', '%electricity%'], ['status', 'like', '1'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');


        $data['te'] = 0;

        $data['date'] = $date;

        return view('admin/report_monthly', $data);
    }

    function daily(Request $request)
    {
        if (!isset($request->date)) {
            $date = Carbon::now()->format("Y-m-d");
        } else {
            $date = Carbon::parse($request->date)->format("Y-m-d");
        }

        $data['data'] = bill_payment::where([['product', 'like', '%data%'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['data_amount'] = bill_payment::where([['product', 'like', '%data%'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');
        $data['airtime'] = bill_payment::where([['product', 'like', '%airtime%'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['airtime_amount'] = bill_payment::where([['product', 'like', '%airtime%'],  ['timestamp', 'LIKE', $date . '%']])->sum('amount');
        $data['tv'] = bill_payment::where([['product', 'like', '%tv%'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['tv_amount'] = bill_payment::where([['product', 'like', '%tv%'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');
        $data['electricity'] = bill_payment::where([['product', 'like', '%electricity%'], ['timestamp', 'LIKE', $date . '%']])->count();
        $data['electricity_amount'] = bill_payment::where([['product', 'like', '%electricity%'], ['timestamp', 'LIKE', $date . '%']])->sum('amount');


        $data['te'] = 0;

        $data['date'] = $date;

        return view('admin/report_daily', $data);
    }
}
