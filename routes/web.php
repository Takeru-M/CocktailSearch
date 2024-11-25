<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/login', function () {
    return view('App');
});

Route::get('/api/dashboard', [ApiController::class, 'fetchDataOfCocktail']);
