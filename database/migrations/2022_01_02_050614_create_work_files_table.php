<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_files', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->date('date');
            $table->string('duration')->nullable();

            $table->time('open_time')->nullable();
            $table->time('close_time');
            
            $table->time('time')->nullable();

            $table->string('times')->nullable();

            $table->date('from_date');
            $table->date('to_date');



            $table->string('show')->nullable();
            $table->string('result_digit')->nullable();

            $table->integer('upload')->nullable()->default(0);
            $table->integer('status')->nullable()->default(1);
            $table->integer('position_bet')->nullable()->default(0);
            

            $table->integer('w_comm')->nullable()->default(15);
            $table->integer('w_times')->nullable()->default(80);
            $table->integer('wother_times')->nullable()->default(0);


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
        Schema::dropIfExists('work_files');
    }
}
