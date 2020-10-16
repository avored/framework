<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\CustomerGroup;

$factory->define(CustomerGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'is_default' => rand(0, 1),
    ];
});
