<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(App\User::class)->create()->id; 
        }, 
        'product_id' => function(){
            return factory(App\Product::class)->create()->id; 
        }, 
        'quantity' => $faker->randomNumber(2),
        'price' => $faker->randomNumber(4), 
        'date' => $faker->date, 
        'store_name' => $faker->name, 
        'comments' => $faker->paragraph,  
    ];
});
