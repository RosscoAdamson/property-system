<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PropertyApi
{
    public static function get(): Response
    {
        return Http::acceptJson()
            ->get(config('properties.api_url'), [
                'api_key' => config('properties.api_key')
            ]);
    }
}
