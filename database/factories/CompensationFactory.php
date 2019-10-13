<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Compensation;
use Faker\Generator as Faker;

$factory->define(Compensation::class, function (Faker $faker) {
    return [
        'total_provision_paid' => $faker->numberBetween(1000, 10000)
    ];
});
