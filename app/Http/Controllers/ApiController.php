<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function fetchDataOfCocktail(Request $request)
    {
        $response = Http::get('https://cocktail-f.com/api/v1/cocktails', $request->all());
        return $response->json();
    }
}
