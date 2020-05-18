<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Malts\Malt;
use App\Beers\Recipe;
use App\Beers\MaltAddition;
use Faker\Generator as Faker;

$factory->define(MaltAddition::class, function (Faker $faker) {
    $malt = Malt::inRandomOrder()->limit(3)->get()->first();
    return [
        'malt_id' => $malt->id,
        'recipe_id' => factory(Recipe::class),
    ];
});
