<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hots', function (Blueprint $table) {
            $table->id();

            $table->integer('work_file_id');

            $table->integer('slip_id')->nullable();

            $table->string('type');
            $table->string('digit');

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
        Schema::dropIfExists('hots');
    }
}
