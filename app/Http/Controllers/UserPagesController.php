<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Developer;
use App\Models\GameGenre;
use App\Models\GameReview;
use App\Models\GameLibrary;
use App\Models\GameDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserPagesController extends Controller
{
    private function setLang()
    {
        if (request()->session()->get('locale') != null) {
            App::setLocale(request()->session()->get('locale'));
        }
    }

    public function wishlistPage()
    {
        $this->setLang();
        $sale_game = Game::getGamebyTag('#sale');

        return view('frontend.wishlist', [
            'category_nav' => GameGenre::get(),
            'active' => 'Wishlist',
            'wishlists' => Wishlist::where('user_id', Auth::user()->id)->get(),
            'sale_game' => $sale_game,
            'genres' => GameGenre::all(),
        ]);
    }

    public function libraryPage()
    {
        $this->setLang();
        return view('frontend.myLibrary', [
            'category_nav' => GameGenre::get(),
            'active' => 'Libraries',
            'myGames' => Game::getuserLibrary(),
        ]);
    }

    public function userProfilePage()
    {
        $this->setLang();
        $games_developed = 0;
        if (Auth::user()->developer) {
            $dev_id = Developer::where('user_id', Auth::user()->id)->first()->id;
            $games_developed = Game::where('dev_id', $dev_id)->count();
        }
        return view('frontend.userProfile.myProfile', [
            'category_nav' => GameGenre::get(),
            'active' => 'Profile',
            'profile' => User::find(Auth::user()->id),
            'donations' => GameDonation::where('user_id', Auth::user()->id)->count(),
            'reviews' => GameReview::where('user_id', Auth::user()->id)->count(),
            'games' => GameLibrary::where('user_id', Auth::user()->id)->count(),
            'games_developed' => $games_developed,
        ]);
    }

    public function userDonationPage()
    {
        $this->setLang();
        return view('frontend.userProfile.donationHistory', [
            'category_nav' => GameGenre::get(),
            'active' => 'Profile',
            'donations' => GameDonation::where('user_id', Auth::user()->id)->get()
        ]);
    }

    public function viewEditUserProfile()
    {
        $this->setLang();

        if (session()->has('success')) {
            $success = true;
        } else {
            $success = false;
        }

        return view('frontend.userProfile.editUserProfile', [
            'category_nav' => GameGenre::get(),
            'active' => 'Profile',
            'User' => Auth::user(),
            'Success' => $success,
        ]);
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

        Alert::success('HOORAY!', 'User profile updated successfully!');
        return redirect()->back()->with('success', 'Success!');
    }
}
