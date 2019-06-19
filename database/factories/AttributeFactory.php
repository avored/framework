<?php
use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Attribute;
use Illuminate\Support\Str;

$factory->define(Attribute::class, function (Faker $faker) {
    $name = $faker->sentence;
  
    return [
        'name' => $name,
        'slug' => Str::slug($name),
    ];
});
