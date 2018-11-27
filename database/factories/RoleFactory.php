<?php

use Faker\Generator as Faker;

$factory->define(AvoRed\Framework\Models\Database\Role::class, function (Faker $faker) {
    return [
        'name' => $faker->text(rand(5,10)),
        'description' => $faker->text(rand(50,60))
    ];
});
