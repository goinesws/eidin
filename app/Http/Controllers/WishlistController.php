<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request){
        Wishlist::create([
            'game_id' => $request->id,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Success!');
    }

    public function removeFromWishlist(Request $request){
        Wishlist::where('game_id' , $request->id)->where('user_id' , Auth::user()->id)->delete();
        return redirect()->back()->with('success', 'Success!');
    }
}
