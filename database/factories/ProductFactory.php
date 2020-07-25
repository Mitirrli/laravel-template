<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'uid' => mt_rand(1,9999),
        'name' => $faker->name,
        'product_type' => mt_rand(1,3),
        'introduction' => $faker->unique()->text(50),
        'created_at' => $faker->dateTimeBetween('-3 year', '-1 year'),
        'updated_at' => $faker->dateTimeBetween('-1 year', '-5 month'),
    ];
});
