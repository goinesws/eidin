<?php

namespace App\Http\Controllers;

use App\Models\GameGenre;
use App\Models\GameTag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdminPagesController extends Controller
{
    private function setLang()
    {
        if (request()->session()->get('locale') != null) {
            App::setLocale(request()->session()->get('locale'));
        }
    }

    public function manageTagsPage()
    {
        $this->setLang();
        return view('admin.manageTag', [
            'category_nav' => GameGenre::get(),
            'active' => 'Admin',
            'User' => Auth::user(),
            'Tags' => GameTag::get()
        ]);
    }

    public function addTagPage()
    {
        $this->setLang();
        return view('admin.addTag', [
            'category_nav' => GameGenre::get(),
            'active' => 'Admin',
            'User' => Auth::user(),
            'Tags' => GameTag::get()
        ]);
    }

    public function updateTagPage(Request $request)
    {
        $this->setLang();
        return view('admin.updateTag', [
            'category_nav' => GameGenre::get(),
            'active' => 'Admin',
            'User' => Auth::user(),
            'Tag' => GameTag::find($request->id)
        ]);
    }

    public function manageCategoriesPage()
    {
        $this->setlang();
        return view('admin.manageCategory', [
            'category_nav' => GameGenre::get(),
            'active' => 'Admin',
            'User' => Auth::user(),
        ]);
    }
}
