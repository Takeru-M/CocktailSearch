<?php

namespace App\Services;

use App\Repositories\CocktailRepository;

class CocktailService {
    protected $cocktailRepository;

    public function __construct (CocktailRepository $cocktailRepository) {
        $this->cocktailRepository = $cocktailRepository;
    }

    public function storeCocktail (array $cocktailData) {
        $existingCocktail = $this->cocktailRepository->findByCocktailId($cocktailData['cocktail_id']);

        if ($existingCocktail) {
            return ['message' => 'Cocktail has been already saved', 'status' => 200];
        }

        $this->cocktailRepository->createCocktail($cocktailData);
        return ['message' => 'Cocktail saved successfully', 'status' => 201];
    }

    public function showCocktail ($cocktailID) {
        $result = $this->cocktailRepository->findByCocktailId($cocktailID);
        return ['message' => 'Get cocktail successfully', 'cocktail' => $result, 'status' => 200];
    }

    public function showCocktails ($cocktailID) {
        $result = $this->cocktailRepository->findByCocktailIDs($cocktailID);
        return ['cocktails' => $result];
    }
}
