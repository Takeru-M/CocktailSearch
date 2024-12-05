<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Favorite;
use App\Models\Cocktail;

class FavoriteController extends Controller
{
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
            $favorite = Favorite::create([
                'user_id' => $userID,
                'cocktail_id' => $cocktailID,
            ]);
            return response()->json(['message' => 'Fav cocktail saved successfully'], 201);
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
            $record = Favorite::where('user_id', $userID)
                                ->where('cocktail_id', $cocktailID)
                                ->first();

            if ($record) {
                $record->delete();
                return response()->json(['message' => 'Fav cocktail deleted successfully.'], 200);
            } else {
                return response()->json(['message' => 'No record found.'], 404);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function getFiveFavCocktails (Request $request) {
        $userID = $request->input('userID');
        try {
            $favCocktailID = Favorite::where('user_id', $userID)->orderBy('created_at', 'asc')->take(5)->pluck('cocktail_id');
            $favCocktail = Cocktail::whereIn('cocktail_id', $favCocktailID)->get();
            return response()->json(['message' => "Get fav data successfully", "favCocktail" => $favCocktail]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
