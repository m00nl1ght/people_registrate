<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManageActTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acts', function(Blueprint $table) {
            $table->dropColumn('instrument');
            $table->dropColumn('status');
            $table->dropForeign(['employee_id']);
            $table->dropColumn('employee_id');

            $table->Integer('contract_number')->nullable();
            $table->string('contract_url', 150)->nullable();

            $table->Integer('tz_number')->nullable();
            $table->string('tz_url', 150)->nullable();

            $table->tinyInteger('ppr')->nullable();
        });

        Schema::table('visitors', function(Blueprint $table) {
            $table->string('position', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
