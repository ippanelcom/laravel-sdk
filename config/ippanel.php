<?php

return [
    /*
    |--------------------------------------------------------------------------
    | IPPanel API Credentials
    |--------------------------------------------------------------------------
    |
    | Here you can specify your IPPanel API key and optionally override the base URL.
    |
    */

    'api_key' => env('IPPANEL_API_KEY', ''),

    'base_url' => env('IPPANEL_BASE_URL', 'https://edge.ippanel.com/v1/api'),
];
