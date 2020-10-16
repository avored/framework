<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\TaxGroup;

$factory->define(TaxGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});
