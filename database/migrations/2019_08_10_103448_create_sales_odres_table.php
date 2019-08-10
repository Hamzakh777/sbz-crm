<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOdresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_ordres', function (Blueprint $table) {
            $table->bigIncrements('id');
            // Contract
            $table->string('owner_full_name');
            $table->string('owner_phone_number');
            $table->text('owner_address');
            $table->string('owner_household_type');
            $table->bigInteger('current_insurance_id');
            $table->bigInteger('new_insurance_id');
            $table->smallInteger('number_of_family_members_in_the_same_household');
            $table->boolean('new_born');
            $table->boolean('move_to_switzerland');
            $table->string('sales_lead_source');
            $table->bigInteger('sales_user_id');
            $table->date('contract_sign_date');
            $table->string('sales_order_status');
            $table->string('insurance_status');
            $table->integer('contract_duration_VVG');
            $table->integer('contract_duration_KVG');
            $table->date('contract_start_VVG');
            $table->date('contract_start_KVG');
            $table->string('insurance_tracking_id');
            $table->date('insurance_submitted_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_odres');
    }
}
