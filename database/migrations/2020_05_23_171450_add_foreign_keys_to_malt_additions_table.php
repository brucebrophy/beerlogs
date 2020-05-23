<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMaltAdditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('malt_additions', function (Blueprint $table) {
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->foreign('malt_id')->references('id')->on('malts');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('malt_additions', function (Blueprint $table) {             
            $table->dropForeign('malt_additions_malt_id_foreign');
            $table->dropForeign('malt_additions_recipe_id_foreign');
            $table->dropForeign('malt_additions_unit_id_foreign');
        });
    }
}
