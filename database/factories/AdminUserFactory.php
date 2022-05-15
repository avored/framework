<?php

namespace AvoRed\Framework\Database\Factories;

use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Database\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
class AdminUserFactory extends Factory
{
    protected $model = AdminUser::class;

    public function definition()
    {
        $role = Role::factory()->create();

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'password' => Hash::make('secret'),
            'role_id' => $role->id,
            'is_super_admin' => rand(0, 1)
        ];
    }
}
