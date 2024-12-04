<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cocktail;
use App\Models\History;
use App\Models\Favorite;
use App\Models\User;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(5)->create();
        Cocktail::factory()->count(5)->create();

        $users = User::all();
        $cocktails = Cocktail::all();
        foreach ($users as $user) {
            $cocktails->each(function($cocktail) use ($user) {
                Favorite::create([
                    'user_id' => $user->id,
                    'cocktail_id' => $cocktail->cocktail_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });
        }
        foreach ($users as $user) {
            $cocktails->each(function($cocktail) use ($user) {
                History::create([
                    'user_id' => $user->id,
                    'cocktail_id' => $cocktail->cocktail_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });
        }
    }
}
