<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzacrustTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzacrust', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description');
            $table->integer('fee');
            $table->string('image')->default('pizzacrust.jpg');
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
        Schema::dropIfExists('pizzacrust');
    }
}
