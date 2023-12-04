<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizedpizzalineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customizedpizzaline', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customizedpizzainfo_id')->unsigned()->nullable();
            $table->foreign('customizedpizzainfo_id')->references('id')->on('customizedpizzainfo');
            $table->integer('pizzatoppings_id')->unsigned()->nullable();
            $table->foreign('pizzatoppings_id')->references('id')->on('pizzatoppings');
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
        Schema::dropIfExists('customizedpizzaline');
    }
}
