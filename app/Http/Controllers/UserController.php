<?php

namespace App\Http\Controllers;

use App\Console\encription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    function viewuserencry()
    {
        $all=User::where('username', Auth::user()->username)->first();
        $user['username']=encription::decryptdata($all->username);
        $user['email']=encription::decryptdata($all->email);
        $user['number']=encription::decryptdata($all->phone);
        $user['name']=encription::decryptdata($all->name);
        return view('myaccount', compact('user', 'all'));
    }
    function updateuserdecry(Request $requset)
    {
     $requset->validate([
         'email'=>'required',
         'name'=>'required',
         'number'=>'required',
     ]);
     $user=User::where('username', Auth::user()->username)->first();
     $user->name=encription::encryptdata($requset->name);
     $user->phone=encription::encryptdata($requset->number);
     $user->email=encription::encryptdata($requset->email);
     $user->save();
     $msg="Profile Update Successfully";
     Alert::success('Success', $msg);
     return back();
    }
    function updateprofilephoto(Request $request)
    {
        $request->validate([
            'pic'=>'required',
        ]);
        $profile = Storage::put('profile', $request['pic']);

        $user=User::where('username', Auth::user()->username)->first();

        $user->profile_photo_path=$profile;
        $user->save();
        $msg="Profile Picture Change Successfully ";
        Alert::success('Success', $msg);
        return back();

    }
    function  removephoto()
    {
        $user=User::where('username',Auth::user()->username)->first();


        if(Storage::exists($user->profile_photo_path)){
            Storage::delete($user->profile_photo_path);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }else{
            Alert::error('Ooops', 'File does not exists');
            return back();
//            dd('File does not exists.');
        }
        $user->profile_photo_path=NULL;
        $user->save();
        $msg="Profile Photo Remove Successful";
        Alert::success('Deleted', $msg);
        return back();
    }

}
