<?php

/*
  |--------------------------------------------------------------------------
  | AvoRed Cart Products Session Identifier
  |--------------------------------------------------------------------------
 */

return [

    'admin_url' => 'admin',

    'symlink_storage_folder' => 'storage',

    'cart' => ['session_key' => 'cart_products'],

    'model' => [
        'user' => AvoRed\Framework\Models\Database\User::class,
        'address' => AvoRed\Framework\Models\Database\Address::class,
    ],

   
    'filesystems' => [    
        'disks' => [
            'avored' => [
                'driver' => 'local',
                'root' => storage_path('app/public'),
            ],
        ],
    ],
    'image' => [
        'driver' => 'gd',
        'sizes' => [
            'small' => ['150', '150'],
            'med' => ['350', '350'],
            'large' => ['750', '750'],
        ],
    ],
    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin-users',
            ],
        ],
    
        'providers' => [
            'admin-users' => [
                'driver' => 'eloquent',
                'model' => AvoRed\Framework\Models\Database\AdminUser::class,
            ],
        ],
    
        'passwords' => [
            'adminusers' => [
                'provider' => 'admin-users',
                'table' => 'admin_password_resets',
                'expire' => 60,
            ],
        ],
    ]
];
