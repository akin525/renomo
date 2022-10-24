<?php

namespace App\Http\Controllers;

use App\Console\encription;
use App\Mail\Emailotp;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            $picture=$user->getAvatar();

            // Check Users Email If Already There
            $is_user = User::where('email', encription::encryptdata($user->getEmail()))->first();
            if(!$is_user){

                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'username' => encription::encryptdata($user->getName().rand(111, 999)),
                    'name' => encription::encryptdata($user->getName()),
                    'email' =>encription::encryptdata($user->getEmail()),
                    'password' =>$user->getName().'@'.$user->getId(),
                    'profile_photo_path'=>$picture,
                ]);
                $wallet= wallet::create([
                    'username'=>$saveUser['username'],
                    'balance' => 0,
                ]);
                $myuser=encription::decryptdata($saveUser['username']);
                $input=[
                    'name'=>$user->getName(),
                    'username'=>$myuser,
                    'email'=>$user->getEmail(),
                    'password'=>'Always sign in with Google',
                ];
                $receiver=$input ['email'];
                $admin= 'info@renomobilemoney.com';
                Mail::to($receiver)->send(new Emailotp($input));
                Mail::to($admin)->send(new Emailotp($input));
            }else{
                $saveUser = User::where('email',  encription::encryptdata($user->getEmail()))->update([
                    'google_id' => $user->getId(),
                    'profile_photo_path'=>$picture,
                ]);
                $saveUser = User::where('email',encription::encryptdata($user->getEmail()))->first();
            }


            Auth::loginUsingId($saveUser->id);

            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
