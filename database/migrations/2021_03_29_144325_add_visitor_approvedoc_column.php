<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisitorApprovedocColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('visitors')) {
            Schema::table('visitors', function (Blueprint $table) {
                $table->string('approve_doc_status', 20)->nullable();
            });
        }  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('visitors')) {
            Schema::table('visitors', function (Blueprint $table) {
                $table->dropColumn('approve_doc_status');
            });
        }
    }
}
