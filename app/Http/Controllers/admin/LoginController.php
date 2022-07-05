<?php

namespace app\Http\Controllers\admin;

use app\Models\admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
public function login(Request $request)
{
    if (Auth()->user()->role == "admin") {
        return redirect()->intended('admin/dashboard')
            ->withSuccess('Signed in');
    } else {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->username)
            ->where('password', $request->password)->where('role', 'admin')
            ->first();

        if (!isset($user)) {
            return redirect()->back()->withInput($request->only('username', 'remember'))
                ->withErrors(['password' => 'Credentials does not match.']);
        }

        Auth::login($user);

        return redirect()->intended('admin/dashboard')
            ->withSuccess('Signed in');
    }
}
}
