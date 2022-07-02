<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request){
        Wishlist::create([
            'game_id' => $request->id,
            'user_id' => Auth::user()->id
        ]);

        Alert::success('Added to Wishlist!', 'This game is added to your wishlist!');
        return redirect()->back()->with('success', 'Success!');
    }

    public function removeFromWishlist(Request $request){
        Wishlist::where('game_id' , $request->id)->where('user_id' , Auth::user()->id)->delete();
        Alert::success('Removed from Wishlist!', 'This game is removed from your wishlist!');
        return redirect()->back()->with('success', 'Success!');
    }
}
