<?php

use Faker\Generator as Faker;

$factory->define(AvoRed\Framework\Models\Database\Product::class, function (Faker $faker) {
    $name = $faker->text(5);
    return [
        'type' => 'BASIC',
        'name' => $name,
        'slug' => str_slug($name),
        'sku' => str_slug($name),
        'description' => $faker->text(50),
        'status' => rand(0,1),
        'in_stock' => rand(0,1),
        'track_stock' => rand(0,1),
        'qty' => rand(1,100),
        'is_taxable' => rand(0,1),
        'price' => rand(10,1000) . '.' . rand(0,10),
        'cost_price' => rand(10,1000) . '.' . rand(0,10),
        'weight' => rand(1,100),
        'height' => rand(1,100),
        'length' => rand(1,100),
        'width' => rand(1,100),
    ];
});
