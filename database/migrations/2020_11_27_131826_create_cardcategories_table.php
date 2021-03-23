<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardcategories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        if (Schema::hasTable('cards')) {
            Schema::table('cards', function (Blueprint $table) {
                $table->unsignedBigInteger('cardcategory_id')->nullable();
                $table->foreign('cardcategory_id')->references('id')->on('cardcategories');
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
        if (Schema::hasTable('cards')) {
            Schema::table('cards', function (Blueprint $table) {
                $table->dropForeign(['category_id']);

                $table->dropColumn('category_id');
              });
        }

        Schema::dropIfExists('cardcategories');
    }
}
