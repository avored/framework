<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\Models\Database\Country;

$factory->define(AvoRed\Framework\Models\Database\Address::class, function (Faker $faker) {
    $user = factory(User::class)->create();
    $type = ['SHIPPING','BILLING'];
    $country = Country::first();

    return [
        'user_id' => $user->id,
        'type' => $type[rand(0,1)],
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address1' => $faker->buildingNumber . ' ' . $faker->streetName,
        'address2' => $faker->secondaryAddress,
        'state' => $faker->state,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'phone' => $faker->phoneNumber,
        'country_id' => $country->id
    ];
});
