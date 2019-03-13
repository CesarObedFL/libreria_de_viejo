<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->randomNumber(null,false),
        'interests' => $faker->text(10),
        'type' => $faker->numberBetween(1,2),
    ];
});
