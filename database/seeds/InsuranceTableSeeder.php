<?php

use Illuminate\Database\Seeder;

class InsuranceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Insurance::class , 50)->create()->each(function($insurance) {
            $user = factory(App\User::class)->create();

            $salesOrders = factory(App\SalesOrder::class, 40)->make([
                'sales_user_id' => $user->id,
                'created_by_id' => $user->id
            ]);
            
            $salesOrders->map(function($item, $key) use (&$insurance){
                $insurance->salesOrders()->save($item);
            });
        });
    }
}
