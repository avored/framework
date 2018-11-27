<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Models\Database\Country;

$factory->define(AvoRed\Framework\Models\Database\State::class, function (Faker $faker) {
    $country = factory(Country::class)->create();
    return [
        'name' => 'new zealand',
        'code' => 'state for new zealand',
        'country_id' => $country->id
    ];
});
