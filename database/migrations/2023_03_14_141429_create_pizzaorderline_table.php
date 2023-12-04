<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzaorderlineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('pizzaorderline', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        Schema::create('pizzaorderline', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pizzaorderinfo_id')->unsigned()->nullable();
            $table->foreign('pizzaorderinfo_id')->references('id')->on('pizzaorderinfo');
            $table->integer('pizza_id')->unsigned()->nullable();
            $table->foreign('pizza_id')->references('id')->on('pizzas');
            $table->integer('quantity');
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
        Schema::dropIfExists('pizzaorderline');
    }
}
