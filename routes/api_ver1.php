<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

Route::get('/dashboard', [ApiController::class, 'fetchDataOfCocktail']);
Route::post('/registerCocktail', [ApiController::class, 'registerCocktail']);
Route::post('/registerFav', [ApiController::class, 'registerFav']);
Route::post('/removeFav', [ApiController::class, 'removeFav']);
Route::post('/tmp', [ApiController::class, 'tmp']);

Route::post('/signin', [AuthController::class, 'signin']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
