<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ContactoUsuario::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'subject' => $faker->sentence(4),
        'message' => $faker->paragraph(2),
    ];
});
