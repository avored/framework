<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\OrderStatus;

$factory->define(OrderStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'is_default' => rand(0, 1),
    ];
});
