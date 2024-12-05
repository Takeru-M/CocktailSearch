<?php

namespace App\Repositories;

use App\Models\History;

class HistoryRepository {
    public function createHistory ($userID, $cocktailID) {
        return History::create(['user_id' => $userID,'cocktail_id' => $cocktailID,]);
    }

    public function getFiveHistories ($userID) {
        return History::where('user_id', $userID)->orderBy('created_at', 'desc')->take(5)->pluck('cocktail_id');
    }
}
