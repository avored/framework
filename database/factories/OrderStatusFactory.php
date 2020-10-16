<?php
namespace AvoRed\Framework\Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\OrderStatus;

$factory->define(OrderStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'is_default' => rand(0, 1),
    ];
});
