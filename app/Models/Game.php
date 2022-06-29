<?php

namespace App\Models;

use App\Models\GameTag;
use App\Models\Wishlist;
use App\Models\Developer;
use App\Models\GameGenre;
use App\Models\TagDetail;
use App\Models\GameReview;
use App\Models\GameLibrary;
use App\Models\GamePayment;
use App\Models\GameDonation;
use App\Models\GameVersionLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    public function gameGenre () {
        return $this->belongsTo(GameGenre::class);
    }

    public function developer () {
        return $this->belongsTo(Developer::class);
    }

    public function gameVersionLogs () {
        return $this->hasMany(GameVersionLog::class);
    }

    public function gameTags () {
        return $this->belongsToMany(GameTag::class);
    }

    public function wishlists () {
        return $this->belongsToMany(Wishlist::class);
    }

    public function gameLibrarys () {
        return $this->belongsToMany(GameLibrary::class);
    }

    public function gameReviews () {
        return $this->hasMany(GameReview::class);
    }

    public function gamePayments () {
        return $this->hasMany(GamePayment::class);
    }

    public function gameDonations () {
        return $this->hasMany(GameDonation::class);
    }

    public function tagDetail () {
        return $this->hasMany(TagDetail::class);
    }
}
