<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Attribute;

$factory->define(Attribute::class, function (Faker $faker) {
    $name = $faker->sentence;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
    ];
});
