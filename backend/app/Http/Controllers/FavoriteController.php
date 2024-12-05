<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Favorite;
use App\Models\Cocktail;
use App\Services\CocktailService;
use App\Services\FavoriteService;

class FavoriteController extends Controller
{
    protected $favoriteService;
    protected $cocktailService;

    public function __construct(FavoriteService $favoriteService, CocktailService $cocktailService)
    {
        $this->favoriteService = $favoriteService;
        $this->cocktailService = $cocktailService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userID = $request->input('userID');
        $cocktailID = $request->input('cocktailID');

        try {
            $result = $this->favoriteService->createFavorite($userID, $cocktailID);
            return response()->json(['message' => $result['message']], $result['status']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function removeFav (Request $request) {
        $userID = $request->input('userID');
        $cocktailID = $request->input('cocktailID');

        try {
            $result = $this->favoriteService->removeFavorite($userID, $cocktailID);
            return response()->json(['message' => $result['message']], $result['status']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function getFiveFavCocktails (Request $request) {
        $userID = $request->input('userID');
        try {
            $CocktailID = $this->favoriteService->getFiveFavorites($userID);
            $favCocktails = $this->cocktailService->showCocktails($CocktailID['fiveFavorites']);
            return response()->json(['message' => "Get fav data successfully", "favCocktail" => $favCocktails['cocktails']]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
