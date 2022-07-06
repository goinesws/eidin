<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameGenre;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPagesController extends Controller
{
    private function setLang(){
        if(request()->session()->get('locale') != null){
            App::setLocale(request()->session()->get('locale'));
        }
    }

    public function pendingGamePage(){
        $this->setLang();
        return view('admin.pendingGame', [
            'active' => 'Admin',
            'category_nav' => GameGenre::get(),
            'games' => Game::where('status', 'pending')->get(),
            'genres' => GameGenre::all(),
        ]);
    }

    public function detailGamePage(Request $request){
        $this->setLang();
        return view('admin.pendingGameDetail', [
            'active' => '',
            'category_nav' => GameGenre::get(),
            'game' => Game::find($request->id),
            'genres' => GameGenre::all(),
        ]);
    }

    public function publishGame(Request $request){
        $this->setLang();

        $game = Game::find($request->game_id);
        $game->status = 'published';
        $game->save();
        Alert::success('Success', 'Game has been published');

        return view('admin.pendingGame', [
            'active' => 'Admin',
            'category_nav' => GameGenre::get(),
            'games' => Game::where('status', 'pending')->get(),
            'genres' => GameGenre::all(),
        ]);
    }

    public function denyGame(Request $request){
        $this->setLang();

        $game = Game::find($request->game_id);
        $game->status = 'denied';
        $game->save();
        Alert::success('Success', 'Game has been denied');

        return view('admin.pendingGame', [
            'active' => 'Admin',
            'category_nav' => GameGenre::get(),
            'games' => Game::where('status', 'pending')->get(),
            'genres' => GameGenre::all(),
        ]);
    }
}
