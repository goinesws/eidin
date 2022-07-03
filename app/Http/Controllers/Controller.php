<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Game;
use App\Models\GameDonation;
use App\Models\GameTag;
use App\Models\GameGenre;
use App\Models\GameLibrary;
use App\Models\GamePayment;
use App\Models\GameReview;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Library;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function calculateRating($game_id)
    {
        return DB::table('game_reviews')
            ->where('game_id', $game_id)
            ->avg('rating');
    }

    public function loginPage()
    {
        return view('login', [
            'active' => 'Login',
            'category_nav' => GameGenre::get(),
        ]);
    }

    public function registerPage()
    {
        return view('register', [
            'active' => '',
            'category_nav' => GameGenre::get(),
        ]);
    }

    public function dashboard()
    {
        //discover games
        $new_game = Game::getGamebyTag('#new');
        $promo_game = Game::getGamebyTag('#promotion');
        $sale_game = Game::getGamebyTag('#sale');
        $genres = GameGenre::all();
        $games = Game::all();
        $ratings = array();

        foreach ($games as $game) {
            $ratings[$game->id] = $this->calculateRating($game->id);
        }

        return view('frontend.dashboard', [
            'category_nav' => GameGenre::get(),
            'active' => 'Home',
            'new_game' => $new_game,
            'promo_game' => $promo_game,
            'sale_game' => $sale_game,
            'genres' => $genres,
            'ratings' => $ratings,
        ]);
    }

    public function searchPage(Request $request)
    {
        return view('frontend.search', [
            'request' => $request->search,
            'category_nav' => GameGenre::get(),
            'active' => '',
            'search_result' => Game::getGamebySearch($request->search),
        ]);
    }

    public function allGame(){
        $ratings = array();
        $games = Game::all();
        $sale_game = Game::getGamebyTag('#sale');

        foreach ($games as $game) {
            $ratings[$game->id] = $this->calculateRating($game->id);
        }

        return view('frontend.allGames', [
            'category_nav' => GameGenre::get(),
            'active' => 'All Games',
            'games' => Game::all(),
            'genres' => GameGenre::all(),
            'ratings' => $ratings,
            'sale_game' => $sale_game
        ]);
    }

    public function gameDetail(Request $request)
    {
        $isOnWishlist = false;
        $isBought = false;
        $myReview = null;

        if(Auth::check() && Auth::user()->role != 'admin'){
            $isOnWishlist = Wishlist::where('game_id', $request->id)->where('user_id', Auth::user()->id)->first();
            $isBought = GameLibrary::where('game_id', $request->id)->where('user_id', Auth::user()->id)->first();
            $myReview = GameReview::where('game_id', $request->id)->where('user_id', Auth::user()->id)->first();
        }

        return view('frontend.gameDetail', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'total_download' => GamePayment::where('game_id', $request->id)->count(),
            'isBought' => $isBought,
            'isOnWishlist' => $isOnWishlist,
            'myReview' => $myReview,
            'donations' => GameDonation::where('game_id', $request->id)->orderBy('created_at', 'desc')->get(),
            'reviews' => GameReview::where('game_id', $request->id)->orderBy('created_at', 'desc')->get(),
            'game' => Game::where('status', 'published')->find($request->id), //Belum di fix N+1 problem , kasih with(['table_name'])
        ]);
    }

    public function gameCategory(Request $request)
    {
        return view('frontend.gameCategory', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'genre' => GameGenre::find($request->id),
            'games' => Game::where('genre_id', $request->id)->where('status', 'published')->get()
        ]);
    }

    public function gamebyTag(Request $request)
    {
        return view('frontend.gamebyTags', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'tag' => GameTag::find($request->id),
            'games' => Game::getGamebyTagID($request->id)
        ]);
    }

    public function companyDetail (Request $request) {
        $ratings = array();
        $games = Game::all();
        $sale_game = Game::getGamebyTag('#sale');

        foreach ($games as $game) {
            $ratings[$game->id] = $this->calculateRating($game->id);
        }

        return view('frontend.companyDetail', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'company' => Developer::find($request->id),
            'games' => Game::where('dev_id', $request->id)->where('status', 'published')->get(),
            'ratings' => $ratings,
            'sale_game' => $sale_game,
            'genres' => GameGenre::all(),
        ]);
    }
}
