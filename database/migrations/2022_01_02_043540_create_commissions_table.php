<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->integer('customer_id')->nullable()->default(1);
            $table->integer('in_out')->default(1);
            
            $table->integer('threed_comm')->nullable()->default(20);
            $table->integer('threed_times')->nullable()->default(550);
            $table->integer('threed_hotpercent')->nullable()->default(0);
            $table->integer('threed_status')->default(1);
            

            $table->integer('onebet_times')->nullable()->default(3);
            $table->integer('position_times')->nullable()->default(6);
            $table->integer('twobet_times')->nullable()->default(10);
            $table->integer('position_comm')->nullable()->default(10);

            $table->integer('agent')->nullable();
            $table->integer('agent_percent')->nullable();
            $table->integer('refer_user_id')->nullable();

            $table->integer('twod_comm')->nullable()->default(15);
            $table->integer('twod_times')->nullable()->default(80);
            $table->integer('twod_hotpercent')->nullable()->default(0);
            $table->integer('twod_status')->nullable()->default(1);

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
        Schema::dropIfExists('commissions');
    }
}
