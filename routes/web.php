<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\GameDonationsController;
use App\Http\Controllers\GameReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPagesController;
use App\Http\Controllers\WishlistController;
use App\Models\GameDonation;
use App\Models\Wishlist;

/*
TODO

login - done ( + design)
register - done ( + design)

dashboard : (design done)
1. select * from new tag (done)
2. select * from promotion tag (done)
3. select * from sale tag (done)

search by category (done di navbar)
search by game name/ dev / tag/ genre (done)

click game detail:
1 all game data (done)
2 select * from review (done, langsung dari laravel)
3. select * from donation (done, langsung dari laravel)
4. my review + my donation pisahin (harus udah ada di library)
5. button tambah donasi + button tambah review (harus udah ada di library)

add wishlist
delete from wishlist
check all wishlist (done)

buy / checkout game
payment

profile:
show profile (done + design)

donation:
show list donasi(done)

library
1. select * from library (done)
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
- approve game (game status udh dibikin di tabel game + game update log)
*/
Route::get('/products', function () {
    return view('/templet_ori/product-details');
});

Route::get('/', [Controller::class, 'dashboard']);
Route::get('/search', [Controller::class, 'searchPage']);
Route::get('/game/{id}', [Controller::class, 'gameDetail']);
Route::get('/category/{id}', [Controller::class, 'gameCategory']);
Route::get('/all-games', [Controller::class, 'allGame']);


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [Controller::class, 'loginPage'])->name('login');
    Route::post('/login/auth', [UserController::class, 'loginAuth']);

    //register
    Route::get('/register', [Controller::class, 'registerPage'])->name('register');
    Route::post('/register/auth', [UserController::class, 'register']);
});

Route::get('/logout', [UserController::class, 'logout']);

//member only
Route::middleware(['user'])->group(function () {
    Route::get('/wishlist', [UserPagesController::class, 'wishlistPage']);
    Route::get('/myLibrary', [UserPagesController::class, 'libraryPage']);
    Route::get('/myProfile', [UserPagesController::class, 'userProfilePage']);
    Route::get('/myDonation', [UserPagesController::class, 'userDonationPage']);

    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist']);
    Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist']);
    Route::post('/review/add', [GameReviewController::class, 'addReview']);
    Route::post('/donation/add', [GameDonationsController::class, 'addDonation']);
});

//dev only
Route::middleware(['dev'])->prefix('dev')->group(function () {
    Route::get('/', function(){return dump(Auth::user());});
});

//admin only
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', function(){return dump(Auth::user());});
});
