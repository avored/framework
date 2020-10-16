<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Country;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'code' => $faker->countryCode,
        'phone_code' => $faker->currencyCode,
        'currency_code' => $faker->currencyCode,
        'currency_symbol' => '$',
        'lang_code' => $faker->languageCode,
    ];
});
