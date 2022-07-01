<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameTag;
use App\Models\GameGenre;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function loginPage(){
        return view('login', [
            'active' => 'Login',
            'category_nav' => GameGenre::get(),
        ]);
    }

    public function registerPage(){
        return view('register', [
            'active' => '',
            'category_nav' => GameGenre::get(),
        ]);
    }

    private function calculateRating($game_id){
        $rating = DB::table('game_reviews')
            ->where('game_id', $game_id)
            ->avg('rating');
        return $rating;
    }

    public function dashboard(){
        //discover games
        $new_game =Game::getGamebyTag('#new');
        $promo_game = Game::getGamebyTag('#promotion');
        $sale_game = Game::getGamebyTag('#sale');
        $genres = GameGenre::all();
        $games = Game::all();
        $promotion = array();
        $ratings = array();

        $userWishlist = null;
        if(Auth::check() && Auth::user()->role == 'user'){
            $userWishlist = Db::table('wishlists')->where('user_id', Auth::user()->id)->get();
        }

        foreach ($games as $game) {
            $promotion[$game->id] = json_decode($game->promotional);
            $ratings[$game->id] = $this->calculateRating($game->id);
        }

        return view('frontend.dashboard', [
            'category_nav' => GameGenre::get(),
            'active' => 'Home',
            'new_game' => $new_game,
            'promo_game' => $promo_game,
            'sale_game' => $sale_game,
            'promotion' => $promotion,
            'genres' => $genres,
            'ratings' => $ratings,
            'userWishlist' => $userWishlist
        ]);
    }

    public function searchPage(Request $request){
        return view('frontend.search', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'search_result' => Game::getGamebySearch($request->search),
        ]);
    }

    public function allGame(){
        return view('frontend.allGames', [
            'category_nav' => GameGenre::get(),
            'active' => 'All Games',
            'games' => Game::all()
        ]);
    }

    public function gameDetail(Request $request){
        return view('frontend.gameDetail', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'game' => Game::where('status','published')->find($request->id), //Belum di fix N+1 problem , kasih with(['table_name'])
        ]);
    }

    public function gameCategory(Request $request){
        return view('frontend.gameCategory', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'games' => Game::where('genre_id', $request->id)->where('status','published')->get()
        ]);
    }
}
