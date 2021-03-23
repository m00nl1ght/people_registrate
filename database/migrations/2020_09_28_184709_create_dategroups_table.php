<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDategroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dategroups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('currentdate_id');
            $table->foreign('currentdate_id')->references('id')->on('currentdates');
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
        Schema::dropIfExists('dategroups');
    }
}
