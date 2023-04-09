<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_permissions', function (Blueprint $table) {
            $table->id();

            $table->integer('work_file_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('customer_id')->nullable()->default(1);

            $table->integer('digit_amount');
            $table->integer('total_amount');
            $table->integer('special_amount')->nullable()->default(0);

            //Core
            $table->string('first')->nullable();
            $table->string('multiple')->nullable();
            $table->integer('file')->nullable();
            $table->integer('max')->nullable();
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
        Schema::dropIfExists('other_permissions');
    }
}
