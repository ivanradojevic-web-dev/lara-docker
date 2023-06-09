<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FindPageService
{
    public function lookupById(int $id): array
    {
        $response = Http::get('https://itunes.apple.com/lookup', [
            'id' => $id,
        ]);

        $result = $response->json()['results'][0];

        return $result;
    }
}
