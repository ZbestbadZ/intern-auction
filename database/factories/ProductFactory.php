<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => 'dis is gud ',
        'start_bid' => '123',
        'minimum_bid' => '20',
        
    ];
});
