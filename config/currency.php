<?php

return [
    'base_currency' => [
        'code' => env('BASE_CURRENCY_CODE', 'HNL'),
        'symbol' => env('BASE_CURRENCY_SYMBOL', 'L'),
    ],
    'target_currency' => [
        'code' => 'USD',
        'symbol' => '$',
    ],
    'currencies' => [
        'HNL',
        'USD'
    ],
    'prefix' => [
        'base_currency' => '',
        'target_currency' => '_USD',
    ]
];
