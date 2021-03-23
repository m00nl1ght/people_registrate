<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardIntoImcomevisitor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (Schema::hasTable('incomevisitors')) {
            Schema::table('incomevisitors', function (Blueprint $table) {
                $table->unsignedBigInteger('card_id')->nullable();
                $table->foreign('card_id')->references('id')->on('cards');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasTable('incomevisitors')) {
            Schema::table('cards', function (Blueprint $table) {
                $table->dropForeign(['card_id']);

                $table->dropColumn('card_id');
              });
        }
    }
}
