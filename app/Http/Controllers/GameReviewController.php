<?php

namespace App\Http\Controllers;

use App\Models\GameReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GameReviewController extends Controller
{
    public function addReview(Request $request){
        $game_id = $request['game_id'];
        $request = $request->validate([
            'rating' => 'required|max:50',
            'comment' => 'max:255',
        ]);

        GameReview::create([
            'game_id' => $game_id,
            'user_id' => Auth::user()->id,
            'rating' => $request['rating'],
            'comment' => $request['comment']
        ]);

        return redirect()->back()->with('success', 'Success!');
    }
}