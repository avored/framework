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
        'user' => App\User::class,
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
            'admin_api' => [
                'driver' => 'passport',
                'provider' => 'admin-users',
                'hash' => false,
            ],
        ],
       
        'providers' => [
            'admin-users' => [
                'driver' => 'eloquent',
                'model' => AvoRed\Framework\Database\Models\AdminUser::class,
            ],
        ],
    
        'passwords' => [
            'adminusers' => [
                'provider' => 'admin-users',
                'table' => 'admin_password_resets',
                'expire' => 60,
            ],
        ],
    ],
    'graphql' => [
        'schemas' => [
            'default' => [
                'query' => [
                    // 'example_query' => ExampleQuery::class,
                    'user_info' => AvoRed\Framework\GraphQL\Query\System\Auth\UserInfoQuery::class
                ],
                'mutation' => [
                    //'userInfo' => AvoRed\Framework\GraphQL\Query\System\Auth\UserInfoQuery::class
                ],
                'middleware' => ['auth:admin_api'],
                'method' => ['get', 'post'],
            ],
            'guest' => [
                'query' => [
                    // 'example_query' => ExampleQuery::class,
                ],
                'mutation' => [
                    'auth' => AvoRed\Framework\GraphQL\Mutation\Auth\Login::class
                ],
                'middleware' => [],
                'method' => ['get', 'post'],
            ],
        ],
        'types' => [
            'token' => \AvoRed\Framework\GraphQL\Type\Auth\TokenType::class,
            'adminUserType' => \AvoRed\Framework\GraphQL\Type\System\AdminUserType::class,
        ],
    ],
];
