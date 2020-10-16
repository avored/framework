<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Customer;
use Carbon\Carbon;

$factory->define(Customer::class, function (Faker $faker) {
    
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'created_at' => Carbon::now()->subMinutes(rand(10, 50000))
    ];
});
