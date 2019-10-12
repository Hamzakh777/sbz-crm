<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SalesOrder;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(SalesOrder::class, function (Faker $faker) {
    return [
        'owner_full_name' => $faker->name,
        'owner_address' => $faker->address,
        'sales_user_id' => 4,
        'contract_sign_date' => $faker->dateTimeBetween(Carbon::now()->copy()->startOfYear(), Carbon::now()->copy()->endOfYear()),
        'sales_order_status' => $faker->randomElement(['processing', 'closing', 'entry']),
    ];
});
