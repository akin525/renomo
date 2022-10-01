<?php

namespace App\Console\Commands;

use App\Console\encription;
use App\Mail\Emailclon;
use App\Models\safe_lock;
use App\Models\User;
use App\Models\wallet;
use App\Models\wi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Interest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Interest:cron';
///usr/local/bin/ea-php80 /home/efemobil/public_html/renomo/artisan schedule:run > /dev/null 2>&1
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
//        Log::info("Cron is working fine!");

        $interest=10;
        $user=safe_lock::where('status', '1')->get();
        foreach ($user as $row) {
            $calA = $interest / 100 * $row["balance"];

            $calPday = round(($calA / 365), 2);
            $username = $row["username"];

            $insect = \App\Models\interest::create([
                'username' => $username,
                'profit' => $calPday,
            ]);
            $mo = $row['balance'] + $calPday;
            $row->balance = $mo;
            $row->save();

        }
        $to= date("Y-m-d");
        $mo=safe_lock::where('date', $to)->where('status', 1)->get();
        foreach ($mo as $row){
            $date=$row["date"];


                    $username=$row["username"];
                    $balance=$row["balance"];

                $in=wi::create([
                    'username'=>$username,
                    'amount'=>$balance,
                ]);
                $kin=$row['balance'] - $balance;
                $row->balance=$kin;
                $row->status=0;
                $row->save();

                $wallet=wallet::where('username', $username)->get();
                foreach ($wallet as $wall){
                    $wa=$wall->balance + $balance;
                    $wall->balance=$wa;
                    $wall->save();

                    $userp=User::where('username', $username)->get();
                    foreach ($userp as $user){
                        $receiver = encription::decryptdata($user->email);
                        $admin = 'info@renomobilemoney.com';


                        Mail::to($receiver)->send(new Emailclon($in));
                        Mail::to($admin)->send(new Emailclon($in));
                    }
                }

        }

    }
}
