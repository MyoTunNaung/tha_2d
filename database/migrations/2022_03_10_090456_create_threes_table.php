<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threes', function (Blueprint $table) {
            $table->id();

            $table->string('digit');
            
            $table->integer('sale_amount')->default(0);
            $table->integer('purchase_amount')->default(0);
            $table->integer('max_amount')->default(0);

            $table->integer('all_amount')->default(0);
            $table->integer('percent_amount')->default(0);

            
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
        Schema::dropIfExists('threes');
    }
}
