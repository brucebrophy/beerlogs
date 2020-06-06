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
            $table->uuid('uuid');
            $table->text('instructions')->nullable();
            $table->integer('abv')->nullable();
            $table->integer('ibu')->nullable();
            $table->decimal('og', 4, 3)->nullable();
            $table->decimal('fg', 4, 3)->nullable();
            $table->integer('srm')->nullable();
            $table->integer('batch_size')->nullable();
            $table->text('adjuncts')->nullable();
            
            $table->bigInteger('unit_id')->unsigned();
            $table->bigInteger('beer_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
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
