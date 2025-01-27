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
use phpDocumentor\Reflection\DocBlock\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;
    protected $fillable = ['genre_id', 'dev_id', 'game_name', 'game_version', 'price', 'promotional', 'game_data_path',  'date_published', 'short_desc', 'content_rating', 'about_game', 'requirement_processor', 'requirement_os', 'requirement_memory', 'requirement_graphic', 'requirement_storage', 'status'];

    public function gameGenre()
    {
        return $this->belongsTo(GameGenre::class, 'genre_id', 'id');
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'dev_id', 'id');
    }

    // public function gameVersionLogs()
    // {
    //     return $this->hasMany(GameVersionLog::class);
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
        // return DB::table('games')
        //     ->join('tag_details', 'tag_details.game_id', '=', 'games.id')
        //     ->join('game_tags', 'game_tags.id', '=', 'tag_details.tag_id')
        //     ->join('game_genres', 'game_genres.id', '=', 'games.genre_id')
        //     ->where('tag_name', '=', $tag)
        //     ->where('status','published') //cuma tampilin yang di publish doang
        //     ->get();

        global $queryTag;
        $queryTag = $tag;
        return Game::with(['gameGenre', 'gameReviews'])->whereHas('tagDetail', function($query){
            $query->whereHas('tag', function($query){
                global $queryTag;
                $query->where('tag_name', $queryTag);
            });
        })->get();
    }

    public static function getGamebyTagID($tag)
    {
        global $queryTag;
        $queryTag = $tag;
        return Game::with(['gameGenre', 'gameReviews'])->whereHas('tagDetail', function($query){
            global $queryTag;
            $query->where('tag_id', $queryTag);
        })->get();
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
            ->where('games.status' , '=', 'published')
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
