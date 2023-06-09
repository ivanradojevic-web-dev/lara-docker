<?php

namespace App\Http\Controllers;

use App\Services\FindPageService;
use Inertia\Inertia;
use Inertia\Response;

class ArtistController extends Controller
{
    public function show($id, FindPageService $findPageService): Response
    {
        $artist = $findPageService->lookupById($id);

        return Inertia::render('Artist/Show', [
            'artist' => $artist,
        ]);
    }
}
