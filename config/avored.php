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
            // 'customer' => [
            //     'driver' => 'session',
            //     'provider' => 'customers',
            // ],
            'admin_api' => [
                'driver' => 'session',
                'provider' => 'admin-users',
                'hash' => false,
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
            // 'customers' => [
            //     'provider' => 'customers',
            //     'table' => 'customer_password_resets',
            //     'expire' => 60,
            // ],
        ],
    ],
    'graphql' => [
        'default_schema' => 'default',
        'schemas' => [
            'default' => [
                'query' => [
                    // 'menu' => \AvoRed\Framework\Graphql\Queries\MenuQuery::class,
                    'allCategory' => \AvoRed\Framework\Graphql\Queries\AllCategoryQuery::class,
                    // 'category' => \AvoRed\Framework\Graphql\Queries\CategoryQuery::class,
                    // 'product' => \AvoRed\Framework\Graphql\Queries\ProductQuery::class,
                    // // 'barcodeProduct' => \AvoRed\Framework\Graphql\Queries\BarcodeProductQuery::class,
                    // 'adminCategoryTable' => \AvoRed\Framework\Graphql\Queries\Admin\Catalog\Category\CategoryTableQuery::class,
                ],
                'mutation' => [
                    // 'login' => \AvoRed\Framework\Graphql\Mutations\Auth\LoginMutation::class,
                    // 'addToCart' => \AvoRed\Framework\Graphql\Mutations\Cart\AddToCartMutation::class,
                    // 'adminLogin' => \AvoRed\Framework\Graphql\Mutations\Admin\User\LoginMutation::class,
                    // 'adminCategoryCreate' => \AvoRed\Framework\Graphql\Mutations\Admin\Catalog\Category\CategoryCreateMutation::class,
                    // 'adminCategoryUpdate' => \AvoRed\Framework\Graphql\Mutations\Admin\Catalog\Category\CategoryUpdateMutation::class,
                    // 'adminCategoryDelete' => \AvoRed\Framework\Graphql\Mutations\Admin\Catalog\Category\CategoryDeleteMutation::class,
                ],
                'middleware' => [],
                'method'     => ['get', 'post'],
            ],
            'secret' => [
                'query' => [
                    'order' => \AvoRed\Framework\Graphql\Queries\OrderQuery::class,
                ],
                'mutation' => [
                    // 'example_mutation'  => ExampleMutation::class,
                ],
                'middleware' => ['auth:api'],
                'method'     => ['get', 'post'],
            ],
        ],

        'types' => [
            // 'menu' => AvoRed\Framework\Graphql\Types\MenuType::class,
            'category' => AvoRed\Framework\Graphql\Types\CategoryType::class,
            // 'filter' => AvoRed\Framework\Graphql\Types\FilterType::class,
            // 'product' => AvoRed\Framework\Graphql\Types\ProductType::class,
            // 'token' => AvoRed\Framework\Graphql\Types\TokenType::class,
            // 'cartProduct' => AvoRed\Framework\Graphql\Types\CartProductType::class,
            // 'order' => AvoRed\Framework\Graphql\Types\OrderType::class,
            // 'address' => AvoRed\Framework\Graphql\Types\AddressType::class,
            // 'delete' => AvoRed\Framework\Graphql\Types\DeleteType::class,
        ],
    ],
];
