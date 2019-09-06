<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Category;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'meta_title' => $faker->sentence,
        'meta_description' => $faker->sentence,
    ];
});
