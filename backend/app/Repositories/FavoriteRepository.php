<?php

namespace App\Repositories;

use App\Models\Favorite;

class FavoriteRepository {
    public function createFavorite ($userID, $cocktailID) {
        return Favorite::create(['user_id' => $userID, 'cocktail_id' => $cocktailID]);
    }

    public function removeFavorite ($userID, $cocktailID) {
        return Favorite::where('user_id', $userID)->where('cocktail_id', $cocktailID)->first()->delete();
    }

    public function getFiveFavorites ($userID) {
        return Favorite::where('user_id', $userID)->orderBy('created_at', 'asc')->take(5)->pluck('cocktail_id');
    }
}
