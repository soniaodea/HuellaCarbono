<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    $password = password_hash('password', PASSWORD_DEFAULT);
    $verified = false;

    return [
        'name' => $faker->name,
        'nif' => strtoupper($faker->randomLetter).$faker->randomNumber(8),
        'telephone' => $faker->randomNumber(9),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ? $password : bcrypt('secret'),
        'verified' => $verified ? $verified : false,
        'remember_token' => str_random(10),
    ];
});
