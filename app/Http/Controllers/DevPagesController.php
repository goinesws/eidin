<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Developer;
use App\Models\GameGenre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DevPagesController extends Controller
{
    public function devRegistPage(){
        return view('dev.devRegistration', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer Registration',
        ]);
    }

    public function purchaseDonation () {
        return view('dev.purchaseDonation', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer',
            'developer' => Developer::find(Auth::user()->developer->id),
            'games' => Game::where('dev_id', Auth::user()->developer->id)->get(),
        ]);
    }
}
