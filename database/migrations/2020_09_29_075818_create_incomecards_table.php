<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomecardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomecards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('in_time', 0);
            $table->time('out_time', 0)->nullable();
            $table->unsignedBigInteger('card_id')->nullable();
            $table->unsignedBigInteger('currentdate_id')->nullable();
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('set null');
            $table->foreign('currentdate_id')->references('id')->on('currentdates')->onDelete('cascade');     
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
        Schema::dropIfExists('incomecards');
    }
}
