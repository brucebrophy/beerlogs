<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->json('instructions')->nullable();
            $table->string('abv')->nullable();
            $table->string('ibu')->nullable();
            $table->string('og')->nullable();
            $table->string('fg')->nullable();
            $table->text('adjuncts')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('beer_id')->unsigned();
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
        Schema::dropIfExists('recipes');
    }
}
