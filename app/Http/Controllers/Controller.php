<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameTag;
use App\Models\GameGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function loginPage(){
        return view('login', [
            'category_nav' => GameGenre::get(),
            'active' => 'Login',
        ]);
    }

    public function dashboard(){
        //discover games
        $new_game =Game::getGamebyTag('#new');
        $promo_game = Game::getGamebyTag('#promo');
        $sale_game = Game::getGamebyTag('#sale');


        return view('frontend.dashboard', [
            'category_nav' => GameGenre::get(),
            'new_game' => $new_game,
            'promo_game' => $promo_game,
            'sale_game' => $sale_game,
            'active' => 'Home',
        ]);
    }

    public function searchPage(Request $request){
        return view('frontend.search', [
            'category_nav' => GameGenre::get(),
            'search_result' => Game::getGamebySearch($request->search),
        ]);
    }

    public function gameDetail(Request $request){
        return view('frontend.gameDetail', [
            'category_nav' => GameGenre::get(),
            'game' => Game::find($request->id) //Belum di fix N+1 problem , kasih with(['table_name'])
        ]);
    }
}
