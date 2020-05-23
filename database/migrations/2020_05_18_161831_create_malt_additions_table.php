<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaltAdditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('malt_additions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('malt_id')->unsigned();
            $table->bigInteger('recipe_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('malt_additions');
    }
}
