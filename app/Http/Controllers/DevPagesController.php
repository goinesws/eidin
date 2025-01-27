<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Wishlist;
use App\Models\Developer;
use App\Models\GameGenre;
use App\Models\GameReview;
use App\Models\GameLibrary;
use App\Models\GamePayment;
use App\Models\GameDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\GameTag;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DevPagesController extends Controller
{
    private function setLang(){
        if(request()->session()->get('locale') != null){
            App::setLocale(request()->session()->get('locale'));
        }
    }

    public function devRegistPage(){
        $this->setLang();
        return view('dev.devRegistration', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer Registration',
        ]);
    }

    public function updateGameInfo(Request $request){
        $this->setLang();
        return view('dev.updateGameInfo', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer',
            'developer' => Developer::find(Auth::user()->developer->id),
            'game' => Game::find($request->id),
        ]);
    }

    public function manageTrailerImage(Request $request){
        $this->setLang();
        return view('dev.manageTrailerImage', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer',
            'developer' => Developer::find(Auth::user()->developer->id),
            'game' => Game::find($request->id),
        ]);
    }

    //devRegist
    public function devRegist(Request $request){

        $this->setLang();
        $this->validate($request, [
            'country' => 'required|max:255',
            'company_name' => 'required|max:255',
            'company_address' => 'required|max:255',
            'bankAccNumber' => 'min:8|max:20',
        ]);

        $dev = new Developer;
        $dev->user_id = Auth::user()->id;
        $dev->country = $request->country;
        $dev->company_name = $request->company_name;
        $dev->registration_date = date('Y-m-d H:i:s');
        $dev->bank_account = json_encode([
            'bank_name' => $request->bankName,
            'bank_account_number' => $request->bankAccNumber,
        ]);
        $dev->company_address = $request->company_address;
        $dev->company_website = $request->company_website;
        $dev->social_media = json_encode([
            'facebook' => $request->fb,
            'twitter' => $request->twt,
            'instagram' => $request->ig,
        ]);
        $dev->company_description = $request->company_description;

        $file = $request->file('photo');
        if($file != null){
            $path = 'img/companyPic/';
            $file->move($path,$file->getClientOriginalName());

            $path = $path.$file->getClientOriginalName();
            $dev->company_pic_url = $path;
        }
        else{
            $dev->company_pic_url = 'img/defaultpic.png';
        }
        $dev->save();

        Alert::success('Success!', 'You Applied To Be A Developer!');
        return redirect('/');
    }

    public function purchaseDonation () {
        $this->setLang();
        return view('dev.purchaseDonation', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer',
            'developer' => Developer::find(Auth::user()->developer->id),
            'games' => Game::with('gamePayments', 'gameDonations')->where('dev_id', Auth::user()->developer->id)->get(),
        ]);
    }

    public function uploadGame(){
        $this->setLang();
        return view('dev.uploadGame', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer',
            'developer' => Developer::find(Auth::user()->developer->id),
        ]);
    }

    public function changePhotoDevPage(){
        $this->setLang();
        return view('dev.changePhotoDev', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer',
        ]);
    }

    public function updateDevPhoto(Request $request){
        $this->validate($request, [
			'photo' => 'required',
		]);
        $file = $request->file('photo');
        $path = 'img/companyPic/';
        $file->move($path,$file->getClientOriginalName());

        $path = $path.$file->getClientOriginalName();
        //update
        Developer::where('user_id', Auth::user()->id)->update([
            'company_pic_url' => $path
        ]);

        $devId = Developer::where('user_id', Auth::user()->id)->first()->id;

        Alert::success('Success!', 'Company Picture Changed!');

        //redirect to dev page id devid
        return redirect('/developer/'.$devId);
    }

    public function editCompanyProfilePage(){
        $this->setLang();
        return view('dev.editCompanyProfile', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer',
            'developer' => Developer::find(Auth::user()->developer->id),
        ]);
    }

    public function gameDetail(Request $request){
        $this->setLang();

        return view('dev.devGameDetail', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'all_tags' => GameTag::all(),
            'total_download' => GamePayment::where('game_id', $request->id)->count(),
            'donations' => GameDonation::with('user')->where('game_id', $request->id)->orderBy('created_at', 'desc')->get(),
            'reviews' => GameReview::where('game_id', $request->id)->orderBy('created_at', 'desc')->get(),
            'game' => Game::find($request->id),
        ]);
    }

    public function editCompanyProfile(Request $request){
        $this->validate($request, [
            'country' => 'required|max:255',
            'company_name' => 'required|max:255',
            'company_address' => 'required|max:255',
            'bankAccNumber' => 'min:8|max:20',
        ]);
        $devId = Developer::where('user_id', Auth::user()->id)->first()->id;
        $dev = Developer::find($devId);
        $dev->country = $request->country;
        $dev->company_name = $request->company_name;
        $dev->company_address = $request->company_address;
        $dev->bank_account = json_encode([
            'bank_name' => $request->bankName,
            'bank_account_number' => $request->bankAccNumber,
        ]);
        $dev->company_website = $request->company_website;
        $dev->social_media = json_encode([
            'facebook' => $request->fb,
            'twitter' => $request->twt,
            'instagram' => $request->ig,
        ]);
        $dev->company_description = $request->company_description;
        $dev->update();
        Alert::success('Success!', 'Company Profile Updated!');
        return redirect('/developer/'.$devId);
    }
}
