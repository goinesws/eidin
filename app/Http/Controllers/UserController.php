<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GameGenre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    private function setLang()
    {
        if (request()->session()->get('locale') != null) {
            App::setLocale(request()->session()->get('locale'));
        }
    }


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

    public function editUserProfile(Request $Request)
    {
        $this->setLang();
        $Request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . Auth::user()->id,
            'country' => 'required|max:50',
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $Request->name;
        $user->username = $Request->username;
        $user->country = $Request->country;
        $user->update();

        Alert::success('Success!', 'User profile updated successfully!');
        return redirect('/myProfile')->with('success', 'Success!');
    }

    public function changePassword(Request $Request)
    {
        $this->setLang();

        $Request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(Auth::user()->id);
        if (Hash::check($Request->current_password, $user->password)) {
            $user->password = Hash::make($Request->new_password);
            $user->save();
            Alert::success('Success!', 'You have successfully changed your password!');
            return redirect('/myProfile');
        } else {
            Alert::error('Process Failed!', 'Your current password is incorrect!');
            return redirect('/changePassword');
        }
    }

    public function updateUserPhoto(Request $request){
        $this->validate($request, [
			'photo' => 'required',
		]);
        $file = $request->file('photo');
        $path = 'img/userProfilePic/';
        $file->move($path,$file->getClientOriginalName());

        $path = $path.$file->getClientOriginalName();
        //update
        User::where('id', Auth::user()->id)->update([
            'profile_url' => $path
        ]);
        Alert::success('Success!', 'Profile Picture Changed!');
        return redirect('/myProfile');
    }
}
