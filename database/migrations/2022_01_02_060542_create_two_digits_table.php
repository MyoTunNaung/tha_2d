<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwoDigitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('two_digits', function (Blueprint $table) {
            $table->id();

            $table->string('digit');

            $table->integer('amount_1');
            $table->integer('amount_2');
            $table->integer('amount_3');
            $table->integer('amount_4');
            $table->integer('amount_5');
            $table->integer('amount_6');
            $table->integer('amount_7');
            $table->integer('amount_8');
            $table->integer('amount_9');
            $table->integer('amount_10');

            $table->integer('amount_11');
            $table->integer('amount_12');
            $table->integer('amount_13');
            $table->integer('amount_14');
            $table->integer('amount_15');
            $table->integer('amount_16');
            $table->integer('amount_17');
            $table->integer('amount_18');
            $table->integer('amount_19');
            $table->integer('amount_20');

            $table->integer('amount_21');
            $table->integer('amount_22');
            $table->integer('amount_23');
            $table->integer('amount_24');
            $table->integer('amount_25');
            $table->integer('amount_26');
            $table->integer('amount_27');
            $table->integer('amount_28');
            $table->integer('amount_29');
            $table->integer('amount_30');

            $table->integer('amount_31');
            $table->integer('amount_32');
            $table->integer('amount_33');
            $table->integer('amount_34');
            $table->integer('amount_35');
            $table->integer('amount_36');
            $table->integer('amount_37');
            $table->integer('amount_38');
            $table->integer('amount_39');
            $table->integer('amount_40');

            $table->integer('amount_41');
            $table->integer('amount_42');
            $table->integer('amount_43');
            $table->integer('amount_44');
            $table->integer('amount_45');
            $table->integer('amount_46');
            $table->integer('amount_47');
            $table->integer('amount_48');
            $table->integer('amount_49');
            $table->integer('amount_50');


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
        Schema::dropIfExists('two_digits');
    }
}
