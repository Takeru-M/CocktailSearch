<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cocktail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cocktail>
 */
class CocktailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Cocktail::class;

    public function definition(): array
    {
        return [
            'cocktail_id' => $this->faker->numberBetween(1, 100),
            'cocktail_name' => $this->faker->word,
            'cocktail_name_english' => $this->faker->word,
            'base_name' => $this->faker->word,
            'technique_name' => $this->faker->word,
            'taste_name' => $this->faker->word,
            'style_name' => $this->faker->word,
            'alcohol' => $this->faker->randomElement([0, 5, 10, 15, 20]),
            'tpo_name' => $this->faker->word,
            'glass_name' => $this->faker->word,
            'type_name' => $this->faker->word,
            'color_name' => $this->faker->word,
            'cocktail_digest' => $this->faker->paragraph,
            'cocktail_desc' => $this->faker->paragraph,
            'recipe_desc' => $this->faker->paragraph,
            'recipes' => json_encode($this->faker->words(5)),
            'tags' => json_encode($this->faker->words(3)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
