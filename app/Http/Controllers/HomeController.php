<?php

namespace App\Http\Controllers;

use App\Services\MusicSearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, MusicSearchService $musicSearchService): Response
    {
        $searchQuery = $request->search ?? '';

        $results = $musicSearchService->search($searchQuery);

        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'results' => $results,
        ]);
    }
}
