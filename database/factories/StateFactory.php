<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\State;

$factory->define(State::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'code' => $faker->countryCode,
    ];
});
