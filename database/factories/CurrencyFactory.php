<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Currency;

$factory->define(Currency::class, function (Faker $faker) {
    return [
        'name' => 'US Dollar',
        'code' => $faker->currencyCode,
        'symbol' => '$',
        'conversation_rate' => rand(1, 100) . '.' . rand(1,99),
        'status' => 'ENABLED',
    ];
});
