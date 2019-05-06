<?php

use Faker\Generator as Faker;

$factory->define(App\Feature::class, function (Faker $faker) {
    return [
    	'bookID' => $faker->numberBetween($min = 1, $max = 50),
    	'edition' => $faker->numberBetween($min = 1, $max = 5),
    	'conditions' => $faker->randomElement($array = array ('buenas','usado','malas')),
        'location' => $faker->numberBetween($min = 0, $max = 13),
    	'place' => $faker->numberBetween($min = 1, $max = 4),
        'language' => $faker->randomElement($array = array ('esp','ing','rus','jap','ale')),
        'price' => $faker->randomFloat(2, $min = 5, $max = 500),
        'status' => $faker->numberBetween($min = 1, $max = 2),
        'stock' => $faker->numberBetween($min = 1, $max = 5),
    ];
});
