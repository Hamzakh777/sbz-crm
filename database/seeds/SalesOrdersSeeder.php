<?php

use Illuminate\Database\Seeder;

class SalesOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function($u) {
            $salesOrders = factory(App\SalesOrder::class, 40)->make([
                'sales_user_id' => $u->id,
                'created_by_id' => $u->id
            ]);
            
            $salesOrders->map(function($item, $key) use (&$u){
                $u->agentSalesOrders()->save($item);
            });
        });
    }
}
