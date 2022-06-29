<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
TODO

login - done
register

dashboard : 
1. select * from new tag (done)
2. select * from promotion tag (done)
3. select * from sale tag (done)

search by category (done di navbar)
search by game name/ dev / tag/ genre (done)

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

Route::get('/', [Controller::class, 'dashboard']);
Route::get('/search', [Controller::class, 'searchPage']);
Route::get('/products', function () {
    return view('/frontend/product-details');
});


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [Controller::class, 'loginPage'])->name('login');
    Route::post('/login/auth', [UserController::class, 'loginAuth']);
});

Route::get('/logout', [UserController::class, 'logout']);

//member
Route::middleware(['user'])->group(function () {
    Route::get('/user', function(){return dump(Auth::user());});
});

//dev
Route::middleware(['dev'])->prefix('dev')->group(function () {
    Route::get('/', function(){return dump(Auth::user());});
});

//admin
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', function(){return dump(Auth::user());});
});
