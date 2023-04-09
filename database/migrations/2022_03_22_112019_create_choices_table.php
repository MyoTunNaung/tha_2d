<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->id();

            $table->integer('auth_id');
            $table->integer('work_file_id')->nullable();

            $table->integer('user_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('in_out')->nullable();
            $table->string('entry')->nullable();
            $table->string('view')->nullable();
            $table->string('keyboard')->nullable();
            $table->string('max_minus')->nullable();
            $table->string('slip')->nullable();

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
        Schema::dropIfExists('choices');
    }
}
