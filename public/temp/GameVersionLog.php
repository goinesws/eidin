<?php

namespace App\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameVersionLog extends Model
{
    use HasFactory;

    public function game () {
        return $this->belongsTo(Game::class);
    }
}
