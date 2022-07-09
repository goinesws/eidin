<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TagDetail;
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
            'processor' => 'required|max:128',
            'os' => 'required|max:128',
            'memory' => 'required|max:128',
            'graphic' => 'required|max:128',
            'storage' => 'required|max:128'
        ]);

        //logo
        $file = $request->file('logo');
        $logo_path = 'img/gameLogo/';
        $file->move($logo_path,$file->getClientOriginalName());
        $logo_path = '/'.$logo_path.$file->getClientOriginalName();


        $img = array();
        $img_path = 'img/gameImage/';
        //img1
        $file = $request->file('img1');
        $file->move($img_path,$file->getClientOriginalName());
        $img1_path = $img_path.$file->getClientOriginalName();
        array_push($img, '/'.$img1_path);

        if($request->img2 != null){
            $file = $request->file('img2');
            $file->move($img_path,$file->getClientOriginalName());
            $img2_path = $img_path.$file->getClientOriginalName();
            array_push($img, '/'.$img2_path);
        }

        if($request->img3 != null){
            $file = $request->file('img3');
            $file->move($img_path,$file->getClientOriginalName());
            $img3_path = $img_path.$file->getClientOriginalName();
            array_push($img, '/'.$img3_path);
        }

        //gameData
        $file = $request->file('game_data');
        $game_data_path = 'data/game_data/';
        $file->move($game_data_path,$file->getClientOriginalName());
        $game_data_path = '/'.$game_data_path.$file->getClientOriginalName();

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

    public function updateGameData(Request $request){
        $game = Game::find($request->id);
        $this->validate($request, [
            'game_name' => 'required|min:1|max:128',
            'game_version' => 'required|min:2|max:32',
            'game_price' => 'required|integer|between:0,999999999',
            'short_desc' => 'required|min:8|max:255',
            'about_game' => 'required|min:16|max:4096',
            'content_rating' => 'required',
            'processor' => 'required|max:128',
            'os' => 'required|max:128',
            'memory' => 'required|max:128',
            'graphic' => 'required|max:128',
            'storage' => 'required|max:128'
        ]);

        Game::where('id', $request->id)->update([
            'game_name' => $request->game_name,
            'game_version' => $request->game_version,
            'price' => $request->game_price,
            'short_desc' => $request->short_desc,
            'content_rating' => $request->content_rating,
            'about_game' => $request->about_game,
            'requirement_processor' => $request->processor,
            'requirement_os' => $request->os,
            'requirement_memory' => $request->memory,
            'requirement_graphic' => $request->graphic,
            'requirement_storage' => $request->storage,
            'status' => ($game->status == 'denied') ? 'pending' : $game->status
        ]);

        Alert::success('Update Game Success!', 'Your Game now updated to the new version!');
        return redirect('/dev/game/'.$request->id);
    }

    public function deleteGameImg(Request $request){
        $game = Game::find($request->game_id);
        $promotional = json_decode($game->promotional);

        $img = array();
        for($i=0;$i<count($promotional->img);$i++){
            if($i != $request->imgIdx){
                array_push($img, $promotional->img[$i]);
            }
        }
        
        Game::where('id', $request->game_id)->update([
            'promotional' => json_encode([
                'logo' => $promotional->logo,
                'trailer' => $promotional->trailer,
                'img' => $img
            ]),
            'status' => ($game->status == 'denied') ? 'pending' : $game->status
        ]);

        Alert::success('Delete Image Success!');
        return redirect('/dev/game/manageTrailerImage/'.$request->game_id);
    }

    public function addGameImg(Request $request){
        $this->validate($request, [
            'addImg' => 'required|image',
        ]);
        $game = Game::find($request->id);
        
        $img_path = 'img/gameImage/';
        //img
        $file = $request->file('addImg');
        $file->move($img_path,$file->getClientOriginalName());
        $img_path = $img_path.$file->getClientOriginalName();

        $promotional = json_decode($game->promotional);

        $img = $promotional->img;
        array_push($img, '/'.$img_path);
        // dump($img);

        Game::where('id', $request->id)->update([
            'promotional' => json_encode([
                'logo' => $promotional->logo,
                'trailer' => $promotional->trailer,
                'img' => $img
            ]),
            'status' => ($game->status == 'denied') ? 'pending' : $game->status
        ]);

        Alert::success('New Image Added Successfully!');
        return redirect('/dev/game/manageTrailerImage/'.$request->id);
    }

    public function updateGameImg(Request $request){
        $this->validate($request, [
            'updateImg' => 'required|image',
        ]);
        $game = Game::find($request->game_id);
        
        $img_path = 'img/gameImage/';
        //img
        $file = $request->file('updateImg');
        $file->move($img_path,$file->getClientOriginalName());
        $img_path = $img_path.$file->getClientOriginalName();
        $promotional = json_decode($game->promotional);

        $img = array();
        for($i=0;$i<count($promotional->img);$i++){
            if($i != $request->imgIdx){
                array_push($img, $promotional->img[$i]);
            }
            else{
                array_push($img, '/'.$img_path);
            }
        }

        Game::where('id', $request->game_id)->update([
            'promotional' => json_encode([
                'logo' => $promotional->logo,
                'trailer' => $promotional->trailer,
                'img' => $img
            ]),
            'status' => ($game->status == 'denied') ? 'pending' : $game->status
        ]);

        Alert::success('Image '.$request->imgIdx.' Changed Succesfully!');
        return redirect('/dev/game/manageTrailerImage/'.$request->game_id);
    }

    public function updateGameTrailer(Request $request){
        $this->validate($request, [
            'trailer' => 'required|url|starts_with:https://www.youtube.com/embed/',
        ]);
        $game = Game::find($request->id);
        $promotional = json_decode($game->promotional);

        Game::where('id', $request->id)->update([
            'promotional' => json_encode([
                'logo' => $promotional->logo,
                'trailer' => $request->trailer,
                'img' => $promotional->img
            ]),
            'status' => ($game->status == 'denied') ? 'pending' : $game->status
        ]);

        Alert::success('Trailer Link Changed Successfully!');
        return redirect('/dev/game/manageTrailerImage/'.$request->id);
    }

    public function updateGameLogo(Request $request){
        $this->validate($request, [
            'logo' => 'required|image',
        ]);
        $game = Game::find($request->id);
        
        $file = $request->file('logo');
        $logo_path = 'img/gameLogo/';
        $file->move($logo_path,$file->getClientOriginalName());
        $logo_path = '/'.$logo_path.$file->getClientOriginalName();

        $promotional = json_decode($game->promotional);
        // dump($img);

        Game::where('id', $request->id)->update([
            'promotional' => json_encode([
                'logo' => $logo_path,
                'trailer' => $promotional->trailer,
                'img' => $promotional->img
            ]),
            'status' => ($game->status == 'denied') ? 'pending' : $game->status
        ]);

        Alert::success('Logo Updated Successfully!');
        return redirect('/dev/game/manageTrailerImage/'.$request->id);
    }

    public function addGameTag(Request $request){
        $this->validate($request, [
            'tag' => 'required',
        ]);

        TagDetail::create([
            'tag_id' => $request->tag,
            'game_id' => $request->id
        ]);

        Alert::success('Tag Added Successfully!');
        return redirect('/dev/game/'.$request->id);
    }

    public function removeGameTag(Request $request){
        TagDetail::where('id', $request->id)->delete();
        Alert::success('Tag Removed Successfully!');
        return redirect()->back();
    }
}
