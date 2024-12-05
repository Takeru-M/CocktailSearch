<?php

namespace App\Services;

use App\Repositories\HistoryRepository;

class HistoryService {
    protected $historyRepository;

    public function __construct (HistoryRepository $historyRepository) {
        $this->historyRepository = $historyRepository;
    }

    public function createHistory ($userID, $cocktailID) {
        $this->historyRepository->createHistory($userID, $cocktailID);
        return ['message' => 'History saved successfully', 'status' => 201];
    }

    public function getFiveHistories ($userID) {
        $result = $this->historyRepository->getFiveHistories($userID);
        return ['fiveHistories' => $result];
    }
}
