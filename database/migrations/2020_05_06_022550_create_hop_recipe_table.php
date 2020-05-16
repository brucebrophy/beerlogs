<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHopRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hop_recipe', function (Blueprint $table) {
            $table->integer('hop_id')->unsigned();
            $table->integer('recipe_id')->unsigned();
            $table->integer('hop_type_id')->unsigned();
            $table->integer('grams');
            $table->integer('minute');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hop_recipe');
    }
}
