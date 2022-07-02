<?php

namespace App\Http\Controllers;

use App\Models\GameDonation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GameDonationsController extends Controller
{
    public function addDonation(Request $request){
        $game_id = $request['game_id'];
        $request = $request->validate([
            'payment' => 'required',
            'amount' => 'required|integer|between:10000,90000000',
            'message' => 'max:255',
        ]);

        GameDonation::create([
            'game_id' => $game_id,
            'user_id' => Auth::user()->id,
            'payment_method' => $request['payment'],
            'amount' => $request['amount'],
            'message' => $request['message']
        ]);

        return redirect()->back()->with('success', 'Success!');
    }
}
