<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IndexNowService
{
    public static function submit(array $urls)
    {
        Http::post('https://api.indexnow.org/indexnow', [
            'host' => 'azwaralearning.com',
            'key' => config('services.indexnow.key'),
            'urlList' => $urls
        ]);
    }
}
