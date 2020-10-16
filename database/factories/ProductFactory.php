<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->sentence;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'type' => 'BASIC',
        'sku' => Str::slug($name),
        'barcode' => $faker->randomNumber(4),
        'description' => $faker->sentence(3000),
        'status' => 1,
        'in_stock' => 1,
        'track_stock' => 1,
        'qty' => rand(100, 300),
        'is_taxable' => 1,
        'price' => $faker->randomNumber(2),
        'cost_price' => $faker->randomNumber(2),
        'weight' => $faker->randomNumber(2),
        'height' => $faker->randomNumber(2),
        'width' => $faker->randomNumber(2),
        'length' => $faker->randomNumber(2),
        'meta_title' => $faker->sentence,
        'meta_description' => $faker->sentence,
    ];
});
