<?php

$factory->define(\RafflesArgentina\FilterableSortable\Models\User::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
    ];
});
