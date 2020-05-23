<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToYeastAdditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('yeast_additions', function (Blueprint $table) {
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->foreign('yeast_id')->references('id')->on('yeasts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('yeast_additions', function (Blueprint $table) {
            $table->dropForeign('yeast_additions_recipe_id_foreign');
            $table->dropForeign('yeast_additions_yeast_id_foreign');
        });
    }
}
