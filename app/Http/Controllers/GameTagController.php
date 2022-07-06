<?php

namespace App\Http\Controllers;

use App\Models\GameTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;

class GameTagController extends Controller
{
    private function setLang()
    {
        if (request()->session()->get('locale') != null) {
            App::setLocale(request()->session()->get('locale'));
        }
    }

    public function addTag(Request $request)
    {
        $this->setlang();

        $request->validate([
            'new_tag_name' => 'required|unique:game_tags,tag_name|starts_with:#',
        ]);

        $tag = new GameTag();
        $tag->id = GameTag::get()->last()->id + 1;
        $tag->tag_name = $request->new_tag_name;
        $tag->save();

        Alert::success('Success!', 'You have successfully added a new Tag!');
        return redirect('/admin/manage-tags');
    }

    public function updateTag(Request $request)
    {
        $this->setlang();

        $request->validate([
            'new_tag_name' => 'required|unique:game_tags,tag_name|starts_with:#',
        ]);

        $tag = GameTag::find($request->id);
        $tag->tag_name = $request->new_tag_name;
        $tag->save();

        Alert::success('Success!', 'You have successfully updated the Tag!');
        return redirect('/admin/manage-tags');
    }

    public function deleteTag(Request $request)
    {
        $this->setlang();

        $tag = GameTag::find($request->id);
        $tag->delete();

        Alert::success('Success!', 'You have successfully deleted the Tag!');
        return redirect('/admin/manage-tags');
    }
}
