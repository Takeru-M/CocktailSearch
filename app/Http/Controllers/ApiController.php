<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function fetchDataOfCocktail(Request $request)
    {
        $response = Http::get('https://cocktail-f.com/api/v1/cocktails', $request->all());
        return $response->json();
    }

    public function tmp (Request $request) {
        return $request;
    }

    //Register cocktails to cocktails table
    public function registerCocktail (Request $request) {
        $data = $request->all();
        $cocktailData = $data['cocktailData'];

        //If there's always the same cocktail, the transaction won't done.

        try {
            $record = Cocktail::where('cocktail_id', $cocktailData['cocktail_id'])
                                ->first();
            if (!$record) {
                $cocktail = Cocktail::create([
                    'cocktail_id' => $cocktailData['cocktail_id'],
                    'cocktail_name' => $cocktailData['cocktail_name'],
                    'cocktail_name_english' => $cocktailData['cocktail_name_english'],
                    'base_name' => $cocktailData['base_name'],
                    'technique_name' => $cocktailData['technique_name'],
                    'taste_name' => $cocktailData['taste_name'],
                    'style_name' => $cocktailData['style_name'],
                    'alcohol' => $cocktailData['alcohol'],
                    'tpo_name' => $cocktailData['tpo_name'],
                    'glass_name' => $cocktailData['glass_name'],
                    'type_name' => $cocktailData['type_name'],
                    'color_name' => $cocktailData['color_name'],
                    'cocktail_digest' => $cocktailData['cocktail_digest'],
                    'cocktail_desc' => $cocktailData['cocktail_desc'],
                    'recipe_desc' => $cocktailData['recipe_desc'],
                    'recipes' => json_encode($cocktailData['recipes']),
                    'tags' => json_encode($cocktailData['tags']),
                ]);

                return response()->json(['message' => 'Cocktail saved successfully', 'cocktailData' => $cocktail], 201);
            } else {
                return response()->json(['message' => 'Cocktail has been already saved'], 201);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    //Register favCocktails to favorites table
    public function registerFav (Request $request) {
        $data = $request->all();
        $userID = $data['userID'];
        $cocktailID = $data['cocktailID'];

        try {
            $favorite = Favorite::create([
                'user_id' => $userID,
                'cocktail_id' => $cocktailID,
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return response()->json(['message' => 'Fav cocktail saved successfully', 'fav' => $favorite], 201);
    }

    public function removeFav (Request $request) {
        $data = $request->all();
        $userID = $data['userID'];
        $cocktailID = $data['cocktailID'];

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
            dd($e->getMessage());
        }
    }
}
