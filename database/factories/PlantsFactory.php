<?php

use Faker\Generator as Faker;

$factory->define(App\Plant::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName(),
        'price' => $faker->randomFloat(2,5,100),
        'tips' => $faker->sentence(3,True,'None'),
        'stock' => $faker->numberBetween(1,5),
        'classification' => $faker->numberBetween(1,15),
    ];
});
