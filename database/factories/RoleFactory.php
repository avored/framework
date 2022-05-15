<?php

namespace AvoRed\Framework\Database\Factories;

use AvoRed\Framework\Database\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
