<?php

namespace App\Http\Controllers;

use App\Services\FindPageService;
use Inertia\Inertia;
use Inertia\Response;

class SongController extends Controller
{
    public function show($id, FindPageService $findPageService): Response
    {
        $song = $findPageService->lookupById($id);

        return Inertia::render('Song/Show', [
            'song' => $song,
        ]);
    }
}
