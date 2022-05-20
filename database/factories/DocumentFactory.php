<?php

namespace AvoRed\Framework\Database\Factories;

use AvoRed\Framework\Database\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $path = $this->faker->word() . DIRECTORY_SEPARATOR . $this->faker->word();

        return [
            'path' => $path,
            'mine_type' => 'image/jpg',
            'size' => $this->faker->randomDigit(),
            'origional_name' => $this->faker->word() . '.' . 'jpg'
        ];
    }
}
