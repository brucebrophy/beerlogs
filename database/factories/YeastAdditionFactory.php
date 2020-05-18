<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Yeasts\Yeast;
use App\Beers\YeastAddition;
use Faker\Generator as Faker;

$factory->define(YeastAddition::class, function (Faker $faker) {
    $yeast = Yeast::inRandomOrder()->limit(3)->get()->first();
    return [
        'yeast_id' => $yeast->id,
        'recipe_id' => factory(Recipe::class),
    ];
});
