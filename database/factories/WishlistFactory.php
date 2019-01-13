<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\Models\Database\Country;
use AvoRed\Framework\Models\Database\Product;

$factory->define(AvoRed\Framework\Models\Database\Wishlist::class, function (Faker $faker) {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();

    return [
        'user_id' => $user->id,
        'product_id' => $product->id
    ];
});
