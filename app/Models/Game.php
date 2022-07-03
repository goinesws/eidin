<?php

namespace App\Models;

use App\Models\Wishlist;
use App\Models\Developer;
use App\Models\GameGenre;
use App\Models\TagDetail;
use App\Models\GameReview;
use App\Models\GameLibrary;
use App\Models\GamePayment;
use App\Models\GameDonation;
use App\Models\GameVersionLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    public function gameGenre()
    {
        return $this->belongsTo(GameGenre::class, 'genre_id', 'id');
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'dev_id', 'id');
    }

    public function gameVersionLogs()
    {
        return $this->hasMany(GameVersionLog::class);
    }

    // public function gameTags()
    // {
    //     return $this->belongsTo(GameTag::class);
    // }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function gameLibrarys()
    {
        return $this->hasMany(GameLibrary::class);
    }

    public function gameReviews()
    {
        return $this->hasMany(GameReview::class);
    }

    public function gamePayments()
    {
        return $this->hasMany(GamePayment::class);
    }

    public function gameDonations()
    {
        return $this->hasMany(GameDonation::class);
    }

    public function tagDetail()
    {
        return $this->hasMany(TagDetail::class);
    }


    //custom

    public static function getGamebyTag($tag)
    {
        return DB::table('games')
            ->join('tag_details', 'tag_details.game_id', '=', 'games.id')
            ->join('game_tags', 'game_tags.id', '=', 'tag_details.tag_id')
            ->where('tag_name', '=', $tag)
            ->where('status','published') //cuma tampilin yang di publish doang
            ->get();
    }

    public static function getGamebyTagID($tag)
    {
        return DB::table('games')
            ->join('tag_details', 'tag_details.game_id', '=', 'games.id')
            ->join('game_tags', 'game_tags.id', '=', 'tag_details.tag_id')
            ->where('game_tags.id', '=', $tag)
            ->where('status','published') //cuma tampilin yang di publish doang
            ->get();
    }

    public static function getGamebySearch($query)
    {
        //game name, game developer, game genre, game tag
        return DB::table('games')
            ->join('tag_details', 'tag_details.game_id', '=', 'games.id')
            ->join('game_tags', 'game_tags.id', '=', 'tag_details.tag_id')
            ->join('game_genres', 'game_genres.id', '=', 'games.genre_id')
            ->join('developers', 'developers.id', '=', 'games.dev_id')

            ->where('games.game_name', 'like', '%' . $query . '%')
            ->orWhere('developers.company_name', 'like', '%' . $query . '%')
            ->orWhere('game_genres.genre_name', $query)
            ->orWhere('game_tags.tag_name', $query)
            ->where('games.status','published')
            ->orderBy('games.id', 'desc')
            ->get();
    }

    public static function getUserLibrary(){
        return DB::table('game_libraries')
            ->join('users', 'users.id', '=', 'game_libraries.user_id')
            ->join('games', 'games.id', '=', 'game_libraries.game_id')
            ->where('game_libraries.user_id', Auth::user()->id)
            ->where('games.status','published')
            ->orderBy('game_libraries.created_at', 'desc')
            ->get();
    }
}
