<?php

namespace App\Http\Controllers;

use App\Services\FindPageService;
use Inertia\Inertia;
use Inertia\Response;

class AlbumController extends Controller
{
    public function show($id, FindPageService $findPageService): Response
    {
        $video = $findPageService->lookupById($id);

        return Inertia::render('Album/Show', [
            'album' => $album,
        ]);
    }
}
