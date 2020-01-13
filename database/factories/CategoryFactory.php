<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
	$name = $faker->words(rand(1,2), true);
	$slug = str_slug($name, '-');
    return [
        'name' => $name,
        'slug' => $slug,
    ];
});
