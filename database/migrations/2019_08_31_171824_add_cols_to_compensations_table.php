<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToCompensationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compensations', function (Blueprint $table) {
            // insurance provision
            $table->tinyInteger('insurance_provision_period_plan_month')->nullable()->unsigned();
            $table->smallInteger('insurance_provision_period_plan_year')->nullable()->unsigned();
            $table->integer('total_provision_paid')->unsigned()->nullable();
            $table->boolean('insurance_provision_period_plan_completed')->default(0);

            // sales compensations
            $table->tinyInteger('sales_compensations_period_plan_month')->nullable()->unsigned();
            $table->smallInteger('sales_compensations_period_plan_year')->nullable()->unsigned();
            $table->integer('sales_compensations_total')->nullable()->unsigned();
            $table->tinyInteger('sales_compensations_payout_rate')->nullable()->unsigned();
            $table->boolean('sales_compensations_period_plan_completed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compensations', function (Blueprint $table) {
            //
        });
    }
}
