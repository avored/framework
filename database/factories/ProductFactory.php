<?php

namespace AvoRed\Framework\Database\Factories;

use AvoRed\Framework\Database\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'type' => 'BASIC',
            'sku' => Str::slug($name),
            'barcode' => $this->faker->randomNumber(4),
            'description' => $this->faker->sentence(3000),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(100, 300),
            'is_taxable' => 1,
            'price' => $this->faker->randomNumber(2),
            'cost_price' => $this->faker->randomNumber(2),
            'weight' => $this->faker->randomNumber(2),
            'height' => $this->faker->randomNumber(2),
            'width' => $this->faker->randomNumber(2),
            'length' => $this->faker->randomNumber(2),
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->sentence,
        ];
    }
}
