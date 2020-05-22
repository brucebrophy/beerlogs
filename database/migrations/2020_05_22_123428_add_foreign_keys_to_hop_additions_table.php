<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHopAdditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hop_additions', function (Blueprint $table) {
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->foreign('hop_id')->references('id')->on('hops');
            $table->foreign('hop_type_id')->references('id')->on('hop_types');
            $table->foreign('hop_method_id')->references('id')->on('hop_methods');
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
        Schema::table('hop_additions', function (Blueprint $table) {
            $table->dropForeign('hop_additions_hop_id_foreign');
            $table->dropForeign('hop_additions_recipe_id_foreign');
            $table->dropForeign('hop_additions_hop_type_id_foreign');
            $table->dropForeign('hop_additions_hop_method_id_foreign');
            $table->dropForeign('hop_additions_unit_id_foreign');
        });
    }
}
