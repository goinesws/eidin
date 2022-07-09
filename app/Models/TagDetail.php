<?php

namespace App\Models;

use App\Models\Game;
use App\Models\GameTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagDetail extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'game_id'];

    public function game () {
        return $this->belongsTo(Game::class);
    }

    public function tag () {
        return $this->belongsTo(GameTag::class);
    }
}
