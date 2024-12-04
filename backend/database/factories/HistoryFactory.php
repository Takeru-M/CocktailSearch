<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\User;
use App\Models\Cocktail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = History::class;

    public function definition(): array
    {
        return [

        ];
    }
}
