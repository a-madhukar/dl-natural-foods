<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word, 
        'description' => $faker->sentence, 
        'unq_code' => str_random(10), 
        'slug' => str_slug($faker->words(3, true)),
    ];
});
