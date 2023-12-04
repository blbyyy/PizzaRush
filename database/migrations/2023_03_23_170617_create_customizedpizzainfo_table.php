<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizedpizzainfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customizedpizzainfo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('pizzacrust_id')->unsigned()->nullable();
            $table->foreign('pizzacrust_id')->references('id')->on('pizzacrust');
            $table->date('ordered_date');
            $table->integer('subtotal');
            $table->integer('discount')->nullable()->default('0');
            $table->integer('total');
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
        Schema::dropIfExists('customizedpizzainfo');
    }
}
