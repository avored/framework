<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\TaxGroup;

$factory->define(TaxGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});
