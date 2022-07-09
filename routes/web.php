<?php

use App\Models\Wishlist;
use App\Models\GameDonation;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameTagController;
use App\Http\Controllers\DevPagesController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\GameGenreController;
use App\Http\Controllers\UserPagesController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\GameReviewController;
use App\Http\Controllers\GamePaymentController;
use App\Http\Controllers\GameDonationsController;


Route::get('/products', function () {
    return view('/templet_ori/product-details');
});

Route::get('/lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return back();
});

Route::get('/', [Controller::class, 'dashboard']);
Route::get('/search', [Controller::class, 'searchPage']);
Route::get('/game/{id}', [Controller::class, 'gameDetail']);
Route::get('/category/{id}', [Controller::class, 'gameCategory']);
Route::get('/tag/{id}', [Controller::class, 'gamebyTag']);
Route::get('/all-games', [Controller::class, 'allGame']);
Route::get('/developer/{id}', [Controller::class, 'companyDetail']);


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
    Route::get('/editMyProfile', [UserPagesController::class, 'editProfilePage']);
    Route::get('/changePassword', [UserPagesController::class, 'changePasswordPage']);
    Route::get('/myProfile/changePhoto', [UserPagesController::class, 'changePhotoPage']);

    //dev registration
    Route::get('/dev-registration', [DevPagesController::class, 'devRegistPage']);
    Route::post('/dev-registration/auth', [DevPagesController::class, 'devRegist']);

    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist']);
    Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist']);
    Route::post('/review/add', [GameReviewController::class, 'addReview']);
    Route::post('/review/edit', [GameReviewController::class, 'editReview']);
    Route::post('/donation/add', [GameDonationsController::class, 'addDonation']);
    Route::post('/game/buy', [GamePaymentController::class, 'buyGame']);
    Route::post('/editMyProfile/edit', [UserController::class, 'editUserProfile']);
    Route::post('/changePassword/edit', [UserController::class, 'changePassword']);
    Route::post('/profile/update-photo', [UserController::class, 'updateUserPhoto']);
});

//dev only
Route::middleware(['dev'])->prefix('dev')->group(function () {
    Route::get('/upload-game', [DevPagesController::class, 'uploadGame']);
    Route::get('/purchase-donation', [DevPagesController::class, 'purchaseDonation']);
    Route::get('/changePhoto-developer', [DevPagesController::class, 'changePhotoDevPage'])->name('changePhotoDev');
    Route::get('/game/{id}', [DevPagesController::class, 'gameDetail']);
    Route::get('/game/updateInfo/{id}', [DevPagesController::class, 'updateGameInfo']);
    Route::get('/game/manageTrailerImage/{id}', [DevPagesController::class, 'manageTrailerImage']);

    //post
    Route::post('/updatePhoto-developer', [DevPagesController::class, 'updateDevPhoto'])->name('photoDevUpdate');
    Route::post('/createGameData', [GameController::class, 'createGameData']);
    Route::get('/edit-company-profile', [DevPagesController::class, 'editCompanyProfilePage'])->name('editCompanyProfilePage');
    Route::post('/edit-company-profile/edit', [DevPagesController::class, 'editCompanyProfile'])->name('editCompanyProfile');
    Route::post('/updateGame/{id}', [GameController::class, 'updateGameData']);
    Route::post('/deleteGameImg/{game_id}/{imgIdx}', [GameController::class, 'deleteGameImg']);
    Route::post('/AddNewImg/{id}', [GameController::class, 'addGameImg']);
    Route::post('/updateGameImage/{game_id}/{imgIdx}', [GameController::class, 'updateGameImg']);
    Route::post('/updateTrailerLink/{id}', [GameController::class, 'updateGameTrailer']);
    Route::post('/updateGameLogo/{id}', [GameController::class, 'updateGameLogo']);
    Route::post('/game/addTag/{id}', [GameController::class, 'addGameTag']);
    Route::post('/game/removeTag/{id}', [GameController::class, 'removeGameTag']);
});

//admin only
Route::middleware(['admin'])->prefix('admin')->group(function () {
    // Route::get('/', function () {
    //     return dump(Auth::user());
    // });
    Route::get('/pending', [AdminPagesController::class, 'pendingGamePage']);
    Route::get('/detail/{id}', [AdminPagesController::class, 'detailGamePage']);
    Route::get('/manage-tags', [AdminPagesController::class, 'manageTagsPage']);
    Route::get('/add-tag', [AdminPagesController::class, 'addTagPage']);
    Route::get('/update-tag/{id}', [AdminPagesController::class, 'updateTagPage']);
    Route::get('/manage-genres', [AdminPagesController::class, 'manageGenresPage']);
    Route::get('/add-genre', [AdminPagesController::class, 'addGenrePage']);
    Route::get('/update-genre/{id}', [AdminPagesController::class, 'updateGenrePage']);
    
    Route::post('/detail/publish', [AdminPagesController::class, 'publishGame']);
    Route::post('/detail/deny', [AdminPagesController::class, 'denyGame']);
    Route::post('/add-tag/add', [GameTagController::class, 'addTag']);
    Route::post('/update-tag/{id}/update', [GameTagController::class, 'updateTag']);
    Route::post('/manage-tags/{id}/delete', [GameTagController::class, 'deleteTag']);
    Route::post('/add-genre/add', [GameGenreController::class, 'create']);
    Route::post('/update-genre/{id}/update', [GameGenreController::class, 'update']);
    Route::Post('/manage-genres/{id}/delete', [GameGenreController::class, 'destroy']);
});
