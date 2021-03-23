<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('in_time', 0);
            $table->string('system', 50);
            $table->string('name');
            $table->string('place');
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('currentdate_id');
            $table->foreign('currentdate_id')->references('id')->on('currentdates')->onDelete('cascade');  
            $table->date('out_date')->nullable();
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
        Schema::dropIfExists('faults');
    }
}
