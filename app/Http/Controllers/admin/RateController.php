<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\deposit;

class RateController extends Controller
{

    function highestdeposit()
    {
        $docs = deposit::groupBy('username')
            ->selectRaw('count(username) as count, username')
            ->selectRaw('sum(amount) as amount')
            ->get();

        return view('admin/ratedeposit', compact('docs'));
    }

}
