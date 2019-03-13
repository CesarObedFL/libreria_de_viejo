<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function(Faker $faker) {
	return [
		'ISBN' => $faker->ISBN10(),
		'title' => $faker->sentence(5,True,'None'),
		'author' => $faker->name(),
		'editorial' => $faker->company(),
		'classification' => $faker->numberBetween($min = 1, $max = 15),
		'genre' => $faker->lexify('Genre ??????'),
		'collection' => $faker->lexify('Coll ??????'),
	];
});