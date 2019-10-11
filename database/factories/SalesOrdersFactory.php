<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SalesOrder;
use Faker\Generator as Faker;

$factory->define(SalesOrder::class, function (Faker $faker) {
    return [
        'owner_full_name' => $faker->name,
        'owner_address' => $faker->address,
        'sales_user_id' => 4,
        'contract_sign_date' => $faker->dateTimeThisYear,
        'sales_order_status' => $faker->randomElement(['processing', 'closing', 'entry']),
    ];
});
