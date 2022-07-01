<?php

namespace App\Models;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = ['game_id', 'user_id'];

    public function games () {
        return $this->belongsTo(Game::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    //
}
