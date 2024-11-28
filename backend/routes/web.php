<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/login', function () {
    return view('App');
});

// Route::get('/{any}', function () {
//     return file_get_contents(public_path('build/index.html'));
// })->where('any', '.*');
