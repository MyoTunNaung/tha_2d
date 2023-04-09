<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDigitPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digit_permissions', function (Blueprint $table) {
            $table->id();

            $table->integer('work_file_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('customer_id')->nullable()->default(1);

            $table->string('type');
            $table->string('digit');
            $table->integer('digit_percent');

            //Core
            $table->string('type_sale')->nullable();
            //Core

            $table->integer('status');
            $table->integer('confirm');         

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
        Schema::dropIfExists('digit_permissions');
    }
}
