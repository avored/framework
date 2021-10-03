<?php

namespace AvoRed\Framework\Database\Factories;

use AvoRed\Framework\Database\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'data_type' => 'VARCHAR',
            'field_type' => 'TEXT',
            'use_for_all_products' => rand(0, 1),
            'sort_order' => rand(0, 100),
        ];
    }
}
