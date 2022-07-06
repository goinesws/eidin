<?php

namespace App\Http\Controllers;

use App\Models\GameGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;

class GameGenreController extends Controller
{
    private function setLang()
    {
        if (request()->session()->get('locale') != null) {
            App::setLocale(request()->session()->get('locale'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->setlang();

        $request->validate([
            'new_genre_name' => 'required|unique:game_genres,genre_name',
        ]);

        $genre = new GameGenre();
        $genre->id = GameGenre::get()->last()->id + 1;
        $genre->genre_name = $request->new_genre_name;
        $genre->save();

        Alert::success('Success!', 'You have successfully added a new Genre!');
        return redirect('/admin/manage-genres');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GameGenre  $gameGenre
     * @return \Illuminate\Http\Response
     */
    public function show(GameGenre $gameGenre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GameGenre  $gameGenre
     * @return \Illuminate\Http\Response
     */
    public function edit(GameGenre $gameGenre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GameGenre  $gameGenre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->setlang();

        $request->validate([
            'new_genre_name' => 'required|unique:game_genres,genre_name,'
        ]);

        $genre = GameGenre::find($request->id);
        $genre->genre_name = $request->new_genre_name;
        $genre->save();

        Alert::success('Success!', 'You have successfully updated a Genre!');
        return redirect('/admin/manage-genres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GameGenre  $gameGenre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->setlang();

        $genre = GameGenre::find($request->id);
        $genre->delete();

        Alert::success('Success!', 'You have successfully deleted a Genre!');
        return redirect('/admin/manage-genres');
    }
}
