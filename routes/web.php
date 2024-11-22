<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    return view('App');
});

Route::get('/api/menu', [ApiController::class, 'fetchDataOfCocktail']);
