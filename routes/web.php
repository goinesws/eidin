<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
TODO

login - done
register

discover game : 
1. select * from new tag
2. select * from promotion tag
3. select * from sale tag

search by category
search by game name / dev name

click game detail:
1 all game data
2 select * from review
3. select * from donation
4. button tambah donasi

add wishlist
delete from wishlist
check all wishlist

buy / checkout game
payment

profile:
show / edit profile
add payment method

library
1. select * from library
2. download game

-dev-
register developer

dashboard:
1. select * from game where dev
2. upload game

game detail:
1. show all data
2. show donation
3. show review
4. update game (insert update log)
5. archive game

admin:
- approve game
*/

Route::get('/', function () {
    return view('/frontend/index');
});

Route::get('/products', function () {
    return view('/frontend/product-details');
});


Route::get('/login', [Controller::class, 'loginPage'])->name('login');
Route::get('/test', function(){return dump(Auth::user());});

Route::get('/logout', [UserController::class, 'logout']);
Route::post('/login/auth', [UserController::class, 'loginAuth']);

//member
Route::middleware(['user'])->group(function () {
    Route::get('/users', function(){return dump(Auth::user());});
});

//dev
Route::middleware(['dev'])->prefix('dev')->group(function () {
    Route::get('/devs', function(){return dump(Auth::user());});
});
