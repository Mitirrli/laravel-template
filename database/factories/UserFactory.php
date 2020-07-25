<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mobile' => $faker->unique()->phoneNumber,
        'sex' => mt_rand(0,2),
        'type' => mt_rand(0,1),
        'created_at' => $faker->dateTimeBetween('-3 year', '-1 year'),
        'updated_at' => $faker->dateTimeBetween('-1 year', '-5 month'),
    ];
});
