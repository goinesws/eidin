<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function loginAuth(Request $request){
        $cred = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($cred)){
            // if($request->input('remember')){
            //     Cookie::queue('LoginCookie', $request->input('email'), 5);
            // }
            // else{
            //     //lupain
            //     Cookie::queue(Cookie::forget('LoginCookie'));
            // }
            return redirect('/test');
        }else{
            return redirect()->back()->withErrors(['msg' => 'Invalid Account']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
