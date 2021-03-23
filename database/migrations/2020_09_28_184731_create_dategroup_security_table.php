<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDategroupSecurityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dategroup_security', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dategroup_id');
            $table->unsignedBigInteger('security_id');
            $table->foreign('dategroup_id')->references('id')->on('dategroups');
            $table->foreign('security_id')->references('id')->on('securities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dategroup_security');
    }
}
