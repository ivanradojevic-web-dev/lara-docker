<?php

namespace App\Http\Controllers;

use App\Services\FindPageService;
use Inertia\Inertia;
use Inertia\Response;

class VideoController extends Controller
{
    public function show($id, FindPageService $findPageService): Response
    {
        $video = $findPageService->lookupById($id);

        return Inertia::render('Video/Show', [
            'video' => $video,
        ]);
    }
}
