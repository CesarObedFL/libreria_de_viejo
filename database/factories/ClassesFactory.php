<?php

use Faker\Generator as Faker;

$factory->define(App\Classification::class, function (Faker $faker) {
    return [
        'class' => $faker->lexify('Clase ??????'),
        'type' => $faker->numberBetween($min = 1, $max = 2),
    ];
});
