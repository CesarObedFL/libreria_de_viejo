<?php

namespace App\Models;

use Faker\Generator as Faker;

$factory->define(Classification::class, function (Faker $faker) {
    return [
        'name' => $faker->lexify('Clase ??????'),
        'type' => $faker->numberBetween($min = 1, $max = 2),
    ];
});
