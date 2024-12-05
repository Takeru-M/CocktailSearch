<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cocktail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CocktailController extends Controller
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
        $cocktailData = $request->input('cocktailData');

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
                return response()->json(['message' => 'Cocktail saved successfully'], 201);
            } else {
                return response()->json(['message' => 'Cocktail has been already saved'], 201);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response(500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $cocktailID = $request->input('cocktailID');

        try {
            $cocktail = Cocktail::where('cocktail_id', $cocktailID)->first();
            if (!$cocktail) {
                return response()->json(['error' => 'Cocktail not found'], 404);
            } else {
                return response()->json(['message' => 'Get cocktail successfully', 'cocktail' => $cocktail]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
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

    public function fetchDataOfCocktail(Request $request){
        $word = $request->query('word');
        $base = $request->query('base');
        $taste = $request->query('taste');
        $tag = $request->query('tag');
        $alcohol_from = $request->query('alcohol_from');
        $alcohol_to = $request->query('alcohol_to');
        $page = $request->query('page');

        try {
            $response = Http::get('https://cocktail-f.com/api/v1/cocktails', [
                'word' => $word,
                'base' => $base,
                'taste' => $taste,
                'tag' => $tag,
                'alcohol_from' => $alcohol_from,
                'alcohol_to' => $alcohol_to,
                'page' => $page
            ]);
            return $response->json();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
