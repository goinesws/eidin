<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamePayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GameLibrary;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GamePaymentController extends Controller
{
    public function buyGame(Request $request){
        $game_id = $request['game_id'];
        $request = $request->validate([
            'payment' => 'required'
        ]);

        $game = Game::where('id', $game_id)->first();

        GamePayment::create([
            'game_id' => $game_id,
            'user_id' => Auth::user()->id,
            'payment_method' => $request['payment'],
            'amount' => $game->price
        ]);

        GameLibrary::create([
            'game_id' => $game_id,
            'user_id' => Auth::user()->id,
        ]);

        //remove kalau ada di wishlist
        Wishlist::where('game_id' , $game_id)->where('user_id' , Auth::user()->id)->delete();
        
        Alert::success('Thank You!', 'You Purchased '.$game->game_name." !");
        return redirect()->back()->with('success', 'Success!');
    }
}
