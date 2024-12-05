<?php

namespace App\Repositories;

use App\Models\Cocktail;

class CocktailRepository
{
    public function findByCocktailId ($cocktailId) {
        return Cocktail::where('cocktail_id', $cocktailId)->first();
    }

    public function findByCocktailIDs ($cocktailID) {
        return Cocktail::whereIn('cocktail_id', $cocktailID)->get();
    }

    public function createCocktail (array $cocktailData) {
        return Cocktail::create([
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
    }
}
