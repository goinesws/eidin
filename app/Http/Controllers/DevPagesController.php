<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Developer;
use App\Models\GameGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
