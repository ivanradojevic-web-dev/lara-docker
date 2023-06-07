<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MusicSearchService
{
    /**
     * Fetch results from iTunes api
     */
    public function search($searchQuery)
    {
        $results = [
            'artists' => $this->fetchData('musicArtist', $searchQuery),
            'songs' => $this->fetchData('song', $searchQuery),
            'albums' => $this->fetchData('album', $searchQuery),
            'videos' => $this->fetchData('musicVideo', $searchQuery),
        ];

        return $results;
    }

    private function fetchData($entity, $searchQuery)
    {
        $response = Http::get('https://itunes.apple.com/search', [
            'term' => $searchQuery,
            'entity' => $entity,
            'limit' => 10,
        ]);

        if ($response->ok()) {
            return $response->json()['results'];
        }

        return [];
    }
}
