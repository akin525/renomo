<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\admin\AdminpdfController;
use App\Http\Controllers\admin\bonusController;
use App\Http\Controllers\admin\Easy;
use App\Http\Controllers\admin\HonorApi;
use App\Http\Controllers\admin\CandCController;
use App\Http\Controllers\admin\LockController;
use App\Http\Controllers\admin\McdController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\QueryController;
use App\Http\Controllers\admin\RateController;
use App\Http\Controllers\admin\TransactionController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\SetController;
use App\Http\Controllers\admin\UserStatementController;
use App\Http\Controllers\admin\VertualAController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\WithadController;
use App\Http\Controllers\AlltvController;
use App\Http\Controllers\AirtimeController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EkectController;
use App\Http\Controllers\GiveawaController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\listdata;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RefersController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SafelockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\verify;
use App\Http\Controllers\VertualController;
use App\Http\Controllers\WithdrawController;
use App\Http\PinController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\BillController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    if (Auth()->user()) {
//        return redirect(route('dashboard'))
//            ->withSuccess('Welcome back '.\App\Console\encription::decryptdata(Auth::user()->name));
//
//    }else {
//        return view('auth.login');
//    }
//});
