<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Developer;
use App\Models\GameGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DevPagesController extends Controller
{
    private function setLang(){
        if(request()->session()->get('locale') != null){
            App::setLocale(request()->session()->get('locale'));
        }
    }

    public function devRegistPage(){
        $this->setLang();
        return view('dev.devRegistration', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer Registration',
        ]);
    }

    //devRegist
    public function devRegist(Request $request){
        $this->setLang();
        $this->validate($request, [
            'country' => 'required|max:255',
            'company_name' => 'required|max:255',
            'company_address' => 'required|max:255',
            'bankAccNumber' => 'min:8|max:20',
        ]);

        $dev = new Developer;
        $dev->user_id = Auth::user()->id;
        $dev->country = $request->country;
        $dev->company_name = $request->company_name;
        $dev->registration_date = date('Y-m-d H:i:s');
        $dev->bank_account = json_encode([
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bankAccNumber,
        ]);
        $dev->company_address = $request->company_address;
        $dev->company_website = $request->company_website;
        $dev->social_media = json_encode([
            'facebook' => $request->fb,
            'twitter' => $request->twt,
            'instagram' => $request->ig,
        ]);
        $dev->company_description = $request->company_description;
        $dev->save();

        return redirect('/');
    }

    public function purchaseDonation () {
        $this->setLang();
        return view('dev.purchaseDonation', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer',
            'developer' => Developer::find(Auth::user()->developer->id),
            'games' => Game::with('gamePayments', 'gameDonations')->where('dev_id', Auth::user()->developer->id)->get(),
        ]);
    }
}
