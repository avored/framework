<?php

use Faker\Generator as Faker;

$factory->define(AvoRed\Framework\Models\Database\UserGroup::class, function (Faker $faker) {
    return [
        'name' =>$faker->text(rand(5,10)),
        'is_default' => rand(0,1)
    ];
});
