<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForegnKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('categories') && Schema::hasTable('news')) {
            Schema::table('news', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id');

                $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign('news_category_id_foreign');
        });
    }
}
