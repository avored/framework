<?php
namespace AvoRed\Framework0\Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Permission;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
