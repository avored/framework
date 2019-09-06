<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Language;

$factory->define(Language::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'code' => $faker->languageCode,
    ];
});
