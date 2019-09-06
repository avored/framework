<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Permission;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
