<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHopAdditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hop_additions', function (Blueprint $table) {
            $table->id();
            $table->integer('hop_id')->unsigned();
            $table->integer('recipe_id')->unsigned();
            $table->integer('hop_type_id')->unsigned();
            $table->integer('amount');
            $table->integer('minute');
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
        Schema::dropIfExists('hop_additions');
    }
}
