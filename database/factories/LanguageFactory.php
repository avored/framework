<?php

use Faker\Generator as Faker;

$factory->define(AvoRed\Framework\Models\Database\Language::class, function (Faker $faker) {
    $name = $faker->text(5);
    return [
        'name' => $name,
        'code' => str_slug($name),
        'is_default' => 0
    ];
});
