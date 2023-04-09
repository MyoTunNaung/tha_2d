<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_bets', function (Blueprint $table) {
            $table->id();

            $table->integer('work_file_id');
            $table->integer('user_id');
            $table->integer('customer_id');

            $table->integer('slip_id');

            $table->string('type');
            $table->string('digit');
            $table->float('amount');

            $table->integer('status')->default(0);
            $table->integer('confirm')->default(0);

            $table->string('remark')->nullable();

            
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
        Schema::dropIfExists('position_bets');
    }
}
