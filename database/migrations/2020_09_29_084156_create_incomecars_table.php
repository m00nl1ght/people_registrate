<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomecarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomecars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('in_time', 0);
            $table->time('out_time', 0)->nullable();
            $table->unsignedBigInteger('visitor_id')->nullable();
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
            $table->unsignedBigInteger('currentdate_id')->nullable();
            $table->foreign('currentdate_id')->references('id')->on('currentdates')->onDelete('cascade');
            $table->unsignedBigInteger('security_id')->nullable();
            $table->foreign('security_id')->references('id')->on('securities')->onDelete('cascade');
            $table->unsignedBigInteger('employee_id')->nullable();
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
        Schema::dropIfExists('incomecars');
    }
}
