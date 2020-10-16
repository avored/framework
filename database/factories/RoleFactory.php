<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text(rand(50, 60)),
    ];
});
