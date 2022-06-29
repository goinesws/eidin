<?php

namespace App\Models;

use App\Models\Game;
use App\Models\TagDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameTag extends Model
{
    use HasFactory;

    public function games () {
        return $this->belongsToMany(Game::class);
    }

    public function tagDetail () {
        return $this->hasMany(TagDetail::class);
    }
}
