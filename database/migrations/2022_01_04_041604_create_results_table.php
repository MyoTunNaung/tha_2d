<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            
            $table->integer('work_file_id');
            $table->integer('user_id');
            $table->integer('customer_id')->nullable()->default(1);
            
            $table->integer('total_amount')->nullable()->default(0);
            $table->integer('commission_amount')->nullable()->default(0);  
            $table->integer('net_total')->nullable()->default(0);

            $table->integer('digit_amount')->nullable()->default(0);
            $table->integer('other_amount')->nullable()->default(0);

            $table->integer('compensation_amount')->nullable()->default(0);
            

            $table->integer('p_total_amount')->nullable()->default(0);
            $table->integer('p_commission_amount')->nullable()->default(0);  
            $table->integer('p_net_total')->nullable()->default(0);

            $table->integer('one_amount')->nullable()->default(0);
            $table->integer('pos_amount')->nullable()->default(0);
            $table->integer('two_amount')->nullable()->default(0);

            $table->integer('p_compensation_amount')->nullable()->default(0);

           
            $table->integer('balance')->nullable()->default(0);

            $table->integer('cash_plus')->nullable()->default(0);
            $table->integer('cash_minus')->nullable()->default(0);
            $table->integer('cash_balance')->nullable()->default(0);        


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
        Schema::dropIfExists('results');
    }
}
