<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ArtistController extends Controller
{
    public function show($id)
    {
        $response = Http::get('https://itunes.apple.com/lookup', [
            'id' => $id,
        ]);

        dd($response->json()['results'][0]);

        $artist = $response->json()['results'][0];

        return Inertia::render('Artist/Show', [
            'artist' => $artist,
        ]);
    }
}
