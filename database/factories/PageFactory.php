<?php

use Faker\Generator as Faker;

$factory->define(AvoRed\Framework\Models\Database\Page::class, function (Faker $faker) {
    $name = $faker->text(5);
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'content' => $faker->text(1000)
    ];
});
