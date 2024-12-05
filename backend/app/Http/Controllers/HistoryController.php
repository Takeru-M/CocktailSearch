<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\History;
use App\Models\Cocktail;

class HistoryController extends Controller
{
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
            $history = History::create([
                'user_id' => $userID,
                'cocktail_id' => $cocktailID,
            ]);
            return response()->json(['message' => 'History saved successfully'], 201);
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
            $cocktailID = History::where('user_id', $userID)->orderBy('created_at', 'desc')->take(5)->pluck('cocktail_id');
            $history = Cocktail::whereIn('cocktail_id', $cocktailID)->get();
            return response()->json(['message' => "Get history successfully", "history" => $history], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
