<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSafetyactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safetyactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('checkbox_id');
            $table->foreign('checkbox_id')->references('id')->on('checkboxes')->onDelete('cascade');
            $table->text('name');
            $table->string('deadline', 50);
            $table->string('performer', 50);
            $table->string('employee', 50);
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
        Schema::dropIfExists('safetyactions');
    }
}
