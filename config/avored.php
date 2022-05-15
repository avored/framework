<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AvoRed Config Information
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */
    'admin_url' => 'admin',

    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin-users',
            ],
            'customer' => [
                'driver' => 'passport',
                'provider' => 'customers',
            ],
        ],
        'providers' => [
            'admin-users' => [
                'driver' => 'eloquent',
                'model' => AvoRed\Framework\Database\Models\AdminUser::class,
            ],
            // 'customers' => [
            //     'driver' => 'eloquent',
            //     'model' => AvoRed\Framework\Database\Models\Customer::class,
            // ],
        ],

        'passwords' => [
            'adminusers' => [
                'provider' => 'admin-users',
                'table' => 'admin_password_resets',
                'expire' => 60,
            ],
            'customers' => [
                'provider' => 'customers',
                'table' => 'customer_password_resets',
                'expire' => 60,
            ],
        ],
    ],

];
