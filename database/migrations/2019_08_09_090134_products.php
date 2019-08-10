<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('insurance_id');
            $table->integer('products_category_id');
            $table->enum('level', [1, 2, 3, 4]);
            $table->enum('franchise', [0, 100, 200, 300, 400, 500, 600, 900, 1000, 1500, 2500, 3000]);
            $table->tinyInteger('age_range_from');
            $table->tinyInteger('age_range_to');
            $table->mediumText('comment');
            $table->mediumInteger('provision');
            $table->mediumInteger('compensation');
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
        //
    }
}
