<?php
return [
    'yemeksepeti' => [
        'username' => env('YEMEKSEPETI_USERNAME'),
        'password' => env('YEMEKSEPETI_PASSWORD'),
    ],
    'getir' => [
        'username' => env('GETIR_USERNAME'),
        'password' => env('GETIR_PASSWORD'),
    ],
    'telegram' => [
        'bot' => [
            'token' => env('TELEGRAM_BOT_TOKEN'),
            'getUsers' => [
                'limit' => env('TELEGRAM_GET_USERS_LIMIT', 5), // default 5
            ],
        ],
    ],
    'vendor' => [
        'id'           => env('VENDOR_ID', 'ttc4'),
        'openingTime'  => env('VENDOR_OPENING_TIME', '9:00'),
        'closingTime'  => env('VENDOR_CLOSING_TIME', '21:00'),
    ],
];
