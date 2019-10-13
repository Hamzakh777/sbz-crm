<?php

use App\SalesOrder;
use Illuminate\Database\Seeder;

class CompensationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salesOrders = SalesOrder::doesntHave('compensation')->get();

        $salesOrders->each(function($salesOrder, $key) {
            $compensation = factory(App\Compensation::class)->make();

            $salesOrder->compensation()->save($compensation);
        });
    }
}
