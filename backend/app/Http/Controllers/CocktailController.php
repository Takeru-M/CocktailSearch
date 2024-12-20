<?php

namespace App\Http\Controllers;

use App\Http\Requests\CocktailRequest;
use Illuminate\Http\Request;
use App\Models\Cocktail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\CocktailService;

class CocktailController extends Controller
{
    protected $cocktailService;

    public function __construct(CocktailService $cocktailService)
    {
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
        $cocktailData = $request->input('cocktailData');

        try {
            $result = $this->cocktailService->storeCocktail($cocktailData);
            return response()->json(['message' => $result['message']], $result['status']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $result = $this->cocktailService->showCocktail($id);
            return response()->json(['message' => $result['message'], 'cocktail' => $result['cocktail']], $result['status']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
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

    public function fetchCocktails(CocktailRequest $request){
        $word = $request->query('word');
        $base = $request->query('base');
        $taste = $request->query('taste');
        $tag = $request->query('tag');
        $alcohol_from = $request->query('alcohol_from');
        $alcohol_to = $request->query('alcohol_to');
        $page = $request->query('page');

        try {
            $response = Http::get('https://cocktail-f.com/api/v1/cocktails', [
                'word' => $word,
                'base' => $base,
                'taste' => $taste,
                'tag' => $tag,
                'alcohol_from' => $alcohol_from,
                'alcohol_to' => $alcohol_to,
                'page' => $page
            ]);
            return $response->json();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
