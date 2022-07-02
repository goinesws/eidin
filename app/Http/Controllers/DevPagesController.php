<?php

namespace App\Http\Controllers;

use App\Models\GameGenre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DevPagesController extends Controller
{
    public function devRegistPage(){
        return view('dev.devRegistration', [
            'category_nav' => GameGenre::get(),
            'active' => 'dev-regist',
        ]);
    }
}
