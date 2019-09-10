<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Property;

$factory->define(Property::class, function (Faker $faker) {
    $name = $faker->sentence;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'data_type' => 'VARCHAR',
        'field_type' => 'TEXT',
        'is_visible_frontend' => rand(0, 1),
        'use_for_all_products' => rand(0, 1),
        'sort_order' => rand(0, 100),
    ];
});
