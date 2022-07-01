<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function loginAuth(Request $request){
        $cred = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($cred)){
            if($request->input('remember')){
                Cookie::queue('LoginEmail', $request->input('email'), 5);
                Cookie::queue('LoginPassword', $request->input('password'), 5);
            }
            else{
                //lupain
                Cookie::queue(Cookie::forget('LoginEmail'));
                Cookie::queue(Cookie::forget('LoginPassword'));
            }
            return redirect('/');
        }else{
            return redirect()->back()->withErrors(['msg' => 'Invalid Account']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function register(Request $request){
        $request->validate([
            'country' => 'required|max:50',
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = new User();
        $user->country = $request->country;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->save();

        return redirect()->route('login');
    }
}
