<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Wishlist;
use App\Models\GameGenre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserPagesController extends Controller
{
    public function wishlistPage(){
        return view('frontend.wishlist', [
            'category_nav' => GameGenre::get(),
            'wishlists' => Wishlist::where('user_id', Auth::user()->id)
        ]);
    }

    public function libraryPage(){
        return view('frontend.myLibrary', [
            'category_nav' => GameGenre::get(),
            'myGames' => Game::getuserLibrary()
        ]);
    }
}
