<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Insurance;
use Faker\Generator as Faker;

$factory->define(Insurance::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
