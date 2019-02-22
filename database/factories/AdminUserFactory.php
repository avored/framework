<?php

use Faker\Generator as Faker;
use AvoRed\Framework\Models\Database\Role;

$factory->define(AvoRed\Framework\Models\Database\AdminUser::class, function (Faker $faker) {
    
    $role = factory(Role::class)->create();
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->phoneNumber),
        'role_id' => $role->id,
        'is_super_admin' => rand(0,1),
        'image_path' => null      
    ];
});
