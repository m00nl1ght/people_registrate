<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeIncomecardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_incomecard', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('incomecard_id');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('incomecard_id')->references('id')->on('incomecards')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('employee_incomecard');
    }
}
