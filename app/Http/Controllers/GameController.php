<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GameController extends Controller
{
    public function createGameData(Request $request){
        $this->validate($request, [
            'genre_id' => 'required',
            'game_name' => 'required|min:1|max:128',
            'game_version' => 'required|min:2|max:32',
            'game_price' => 'required|integer|between:0,999999999',
            'short_desc' => 'required|min:8|max:255',
            'about_game' => 'required|min:16|max:4096',
            'content_rating' => 'required',
            'logo' => 'required|image',
            'img1' => 'required|image',
            'img2' => 'image',
            'img3' => 'image',
            'trailer' => 'required|url|starts_with:https://www.youtube.com/embed/',
            'game_data' => 'required',
            'processor' => 'required|max:64',
            'os' => 'required|max:64',
            'memory' => 'required|max:32',
            'graphic' => 'required|max:64',
            'storage' => 'required|max:16'
        ]);

        //logo
        $file = $request->file('logo');
        $logo_path = 'img/gameLogo/';
        $file->move($logo_path,$file->getClientOriginalName());
        $logo_path = $logo_path.$file->getClientOriginalName();


        $img = array();
        $img_path = 'img/gameImage/';
        //img1
        $file = $request->file('img1');
        $file->move($img_path,$file->getClientOriginalName());
        $img1_path = $img_path.$file->getClientOriginalName();
        array_push($img, $img1_path);

        if($request->img2 != null){
            $file = $request->file('img2');
            $file->move($img_path,$file->getClientOriginalName());
            $img2_path = $img_path.$file->getClientOriginalName();
            array_push($img, $img2_path);
        }

        if($request->img3 != null){
            $file = $request->file('img3');
            $file->move($img_path,$file->getClientOriginalName());
            $img3_path = $img_path.$file->getClientOriginalName();
            array_push($img, $img3_path);
        }

        //gameData
        $file = $request->file('game_data');
        $game_data_path = 'data/game_data/';
        $file->move($game_data_path,$file->getClientOriginalName());
        $game_data_path = $game_data_path.$file->getClientOriginalName();

        Game::create([
            'genre_id' => $request->genre_id,
            'dev_id' => Auth::user()->developer->id,
            'game_name' => $request->game_name,
            'game_version' => $request->game_version,
            'price' => $request->game_price,
            'promotional' => json_encode([
                'logo' => $logo_path,
                'trailer' => $request->trailer,
                'img' => $img
            ]),
            'game_data_path' => $game_data_path,
            'date_published' => date('Y-m-d H:i:s'),
            'short_desc' => $request->short_desc,
            'content_rating' => $request->content_rating,
            'about_game' => $request->about_game,
            'requirement_processor' => $request->processor,
            'requirement_os' => $request->os,
            'requirement_memory' => $request->memory,
            'requirement_graphic' => $request->graphic,
            'requirement_storage' => $request->storage,
            'status' => 'pending'
        ]);

        Alert::success('Submit Game Success!', 'Wait until admin approve your game!');
        return redirect('/developer/'.Auth::user()->developer->id);
    }
}
