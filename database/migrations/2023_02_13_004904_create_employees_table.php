<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('employees', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        Schema::create('employees', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            $table->increments('id');
            $table->text('name');
            $table->text('gender');
            $table->text('phone');
            $table->text('address');
            $table->date('birthdate');
            $table->string('image')->default('employee.jpg');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
