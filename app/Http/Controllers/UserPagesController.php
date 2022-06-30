<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Wishlist;
use App\Models\GameGenre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GameDonation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPagesController extends Controller
{
    public function wishlistPage(){
        return view('frontend.wishlist', [
            'category_nav' => GameGenre::get(),
            'active' => 'Wishlist',
            'wishlists' => Wishlist::where('user_id', Auth::user()->id),
        ]);
    }

    public function libraryPage(){
        return view('frontend.myLibrary', [
            'category_nav' => GameGenre::get(),
            'active' => 'Libraries',
            'myGames' => Game::getuserLibrary(),
        ]);
    }

    public function userProfilePage(){
        return view('frontend.userProfile.myProfile', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'profile' => User::find(Auth::user()->id)
        ]);
    }

    public function userDonationPage(){
        return view('frontend.userProfile.donationHistory', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'donations' => GameDonation::where('user_id', Auth::user()->id)->get()
        ]);
    }
}
