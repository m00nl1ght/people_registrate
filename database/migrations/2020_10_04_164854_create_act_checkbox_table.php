<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActCheckboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_checkbox', function (Blueprint $table) {
            $table->unsignedBigInteger('act_id');
            $table->unsignedBigInteger('checkbox_id');
            $table->foreign('act_id')->references('id')->on('acts')->onDelete('cascade');
            $table->foreign('checkbox_id')->references('id')->on('checkboxes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('act_checkbox');
    }
}
