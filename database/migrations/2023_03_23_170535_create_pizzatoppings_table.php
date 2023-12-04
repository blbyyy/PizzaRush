<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzatoppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzatoppings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description');
            $table->integer('fee');
            $table->string('img_path')->default('pizzatoppings.jpg');
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
        Schema::dropIfExists('pizzatoppings');
    }
}
