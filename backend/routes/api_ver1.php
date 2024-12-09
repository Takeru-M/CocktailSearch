<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CocktailController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HistoryController;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/cocktail/fetchCocktails', [CocktailController::class, 'fetchCocktails']);
    Route::resource('user', UserController::class);
    Route::resource('cocktail', CocktailController::class);
    Route::resource('favorite', FavoriteController::class);
    Route::resource('history', HistoryController::class);
    Route::get('/favorite/{userID}/{cocktailID}', [FavoriteController::class, 'isFav']);
    Route::post('/removeFav', [FavoriteController::class, 'removeFav']);
    Route::post('/cocktail/get_five_fav_cocktails', [FavoriteController::class, 'getFiveFavCocktails']);
    Route::post('/cocktail/get_five_histories', [HistoryController::class, 'getFiveHistories']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/signin', [AuthController::class, 'signin']);
// Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
