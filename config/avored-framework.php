<?php

/*
  |--------------------------------------------------------------------------
  | AvoRed Cart Products Session Identifier
  |--------------------------------------------------------------------------
 */

return [
    'cart' => ['session_key' => 'cart_products'],

    'model' => [
        'user' => AvoRed\Ecommerce\Models\Database\User::class,
        'address' => AvoRed\Ecommerce\Models\Database\Address::class,
    ],

    'image' => [
        'driver' => 'gd',
        'sizes' => [
            'small' => ['150', '150'],
            'med' => ['350', '350'],
            'large' => ['750', '750'],
        ],
    ]
];
