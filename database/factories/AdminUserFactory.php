<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Database\Models\AdminUser;

$factory->define(AdminUser::class, function (Faker $faker) {
    $role = factory(Role::class)->create();

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => 'secret',
        'role_id' => $role->id,
        'is_super_admin' => rand(0, 1),
        'image_path' => null,
    ];
});
