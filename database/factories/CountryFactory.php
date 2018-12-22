<?php

use Faker\Generator as Faker;

$factory->define(AvoRed\Framework\Models\Database\Country::class, function (Faker $faker) {
    return [
        'name' => 'new zealand',
        'code' => 'nzd',
        'phone_code' => '0064',
        'currency_code' => 'NZD',
        'currency_symbol' => '$',
        'lang_code' => 'English'
    ];
});
