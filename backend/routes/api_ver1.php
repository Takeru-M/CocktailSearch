<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/dashboard', [ApiController::class, 'fetchDataOfCocktail']);
    Route::post('/registerCocktail', [ApiController::class, 'registerCocktail']);
    Route::post('/getCocktail', [ApiController::class, 'getCocktail']);
    Route::post('/registerHistory', [ApiController::class, 'registerHistory']);
    Route::post('/getHistory', [ApiController::class, 'getHistory']);
    Route::post('/registerFav', [ApiController::class, 'registerFav']);
    Route::post('/removeFav', [ApiController::class, 'removeFav']);
    Route::post('/getFavCocktail', [ApiController::class, 'getFavCocktail']);
    Route::post('/tmp', [ApiController::class, 'tmp']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/signin', [AuthController::class, 'signin']);
// Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
