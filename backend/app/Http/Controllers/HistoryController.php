<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\History;
use App\Models\Cocktail;
use App\Services\CocktailService;
use App\Services\HistoryService;

class HistoryController extends Controller
{
    protected $historyService;
    protected $cocktailService;

    public function __construct (HistoryService $historyService, CocktailService $cocktailService) {
        $this->historyService = $historyService;
        $this->cocktailService = $cocktailService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userID = $request->input('userID');
        $cocktailID = $request->input('cocktailID');

        try {
            $result = $this->historyService->createHistory($userID, $cocktailID);
            return response()->json(['message' => $result['message']], $result['status']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getFiveHistories (Request $request) {
        $userID = $request->input('userID');
        try {
            $CocktailID = $this->historyService->getFiveHistories($userID);
            $histories= $this->cocktailService->showCocktails($CocktailID['fiveHistories']);
            return response()->json(['message' => "Get history successfully", "history" => $histories['cocktails']], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
