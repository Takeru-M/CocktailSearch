<?php

namespace App\Services;

use App\Repositories\FavoriteRepository;

class FavoriteService {
    protected $favoriteRepository;

    public function __construct (FavoriteRepository $favoriteRepository) {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function createFavorite ($userID, $cocktailID) {
        $this->favoriteRepository->createFavorite($userID, $cocktailID);
        return ['message' => 'Favorite craeted successfully', 'status' => 201];
    }

    public function removeFavorite ($userID, $cocktailID) {
        $this->favoriteRepository->removeFavorite($userID, $cocktailID);
        return ['message' => 'Favorite removed successfully',  'status' => 200];
    }

    public function getFiveFavorites ($userID) {
        $result = $this->favoriteRepository->getFiveFavorites($userID);
        return ['fiveFavorites' => $result];
    }
}
