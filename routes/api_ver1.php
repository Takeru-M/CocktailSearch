<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;

Route::post('/login', [UserController::class, 'login']);
Route::get('/menu', [ApiController::class, 'fetchDataOfCocktail']);
