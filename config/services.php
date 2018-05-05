<?php

return [
    'google' => [
        'client_id' => env('GOOGLE_PUBLIC'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect' => env('APP_URL') . 'login/google/callback',
    ],
];
