<?php

namespace App\Models;

use Faker\Generator as Faker;

$factory->define(Book::class, function(Faker $faker) {
	return [
		'ISBN' => $faker->ISBN10(),
		'title' => $faker->sentence(5,True,'None'),
		'author' => $faker->name(),
		'editorial' => $faker->company(),
		'classification_id' => $faker->numberBetween($min = 1, $max = 15),
		'genre' => $faker->lexify('Genre ??????'),
		'collection' => $faker->lexify('Coll ??????'),
		// BOOK FEATURES
    	'edition' => $faker->numberBetween($min = 1, $max = 5),
    	'conditions' => $faker->randomElement($array = array ('buenas','usado','malas')),
    	'location' => $faker->numberBetween($min = 0, $max = 13),
    	'place' => $faker->numberBetween($min = 1, $max = 4),
        'price' => $faker->randomFloat(2, $min = 5, $max = 500),
        'stock' => $faker->numberBetween($min = 1, $max = 5),
	];
});