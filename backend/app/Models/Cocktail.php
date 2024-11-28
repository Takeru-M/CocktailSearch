<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    protected $fillable = [
        'cocktail_id',
        'cocktail_name',
        'cocktail_name_english',
        'base_name',
        'technique_name',
        'taste_name',
        'style_name',
        'alcohol',
        'tpo_name',
        'glass_name',
        'type_name',
        'color_name',
        'cocktail_digest',
        'cocktail_desc',
        'recipe_desc',
        'recipes',
        'tags'
    ];
}
