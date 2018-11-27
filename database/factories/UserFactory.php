<?php

use Faker\Generator as Faker;

$factory->define(AvoRed\Framework\Models\Database\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->phoneNumber),
        'phone' => $faker->phoneNumber,
        'status' => 'LIVE'
        
    ];
});
