<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Database\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

$factory->define(AdminUser::class, function (Faker $faker) {
    $role = factory(Role::class)->create();

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => Hash::make('secret'),
        'role_id' => $role->id,
        'is_super_admin' => rand(0, 1),
        'image_path' => null,
    ];
});
