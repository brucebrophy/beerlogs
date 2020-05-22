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
            $table->bigInteger('hop_id')->unsigned();
            $table->bigInteger('recipe_id')->unsigned();
            $table->bigInteger('hop_type_id')->unsigned();
            $table->bigInteger('hop_method_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->integer('amount');
            $table->integer('minute')->nullable();
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
