<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Malts\Malt;
use App\System\Unit;
use App\Beers\Recipe;
use App\Beers\MaltAddition;
use Faker\Generator as Faker;

$factory->define(MaltAddition::class, function (Faker $faker) {
    $malt = Malt::inRandomOrder()->first();
    $unit = Unit::whereIn('symbol', ['lb', 'kg'])->inRandomOrder()->first();
    return [
        'malt_id' => $malt->id,
        'recipe_id' => factory(Recipe::class),
        'unit_id' => $unit->id,
        'amount' => $faker->numberBetween(5, 20),
    ];
});
