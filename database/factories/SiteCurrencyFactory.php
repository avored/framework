<?php

use Faker\Generator as Faker;

$factory->define(AvoRed\Framework\Models\Database\SiteCurrency::class, function (Faker $faker) {
    return [
        'name' => 'currency name',
        'code' => $faker->currencyCode,
        'symbol' => '$',
        'conversion_rate' => 1.00,
        'status' => 'ENABLED'
    ];
});
