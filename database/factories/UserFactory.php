<?php

use Faker\Generator as Faker;
use Faker\Factory;

$factory->define(App\User::class, function (Faker $faker) {

    // TODO set random password?
    $password = 'pass';

    return [
        'role_id' => function() {
            return factory(App\Role::class)->create()->id;
        },
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt($password), // pass
        'remember_token' => str_random(10),
    ];
});
