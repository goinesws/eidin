<?php

namespace App\Models;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameLibrary extends Model
{
    use HasFactory;

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function games () {
        return $this->hasMany(Game::class);
    }
}
