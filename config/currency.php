<?php

return [
    'base_currency' => [
        'code' => env('BASE_CURRENCY_CODE', 'NIO'),
        'symbol' => env('BASE_CURRENCY_SYMBOL', 'C$'),
    ],
    'target_currency' => [
        'code' => 'USD',
        'symbol' => '$',
    ],
    'currencies' => [
        'NIO',
        'USD'
    ],
    'prefix' => [
        'base_currency' => '',
        'target_currency' => '_USD',
    ]
];
