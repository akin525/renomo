<?php

namespace App\Http\Controllers;

use App\Console\encription;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

            // Check Users Email If Already There
            $is_user = User::where('email', encription::encryptdata($user->getEmail()))->first();
            if(!$is_user){

                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'username' => encription::encryptdata($user->getName().rand(111, 999)),
                    'name' => encription::encryptdata($user->getName()),
                    'email' =>encription::encryptdata($user->getEmail()),
                    'password' =>$user->getName().'@'.$user->getId()
                ]);
                $wallet= wallet::create([
                    'username'=>$saveUser['username'],
                    'balance' => 0,
                ]);
            }else{
                $saveUser = User::where('email',  encription::encryptdata($user->getEmail()))->update([
                    'google_id' => $user->getId(),
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
