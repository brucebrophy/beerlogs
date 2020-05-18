<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Malts\Malt;
use App\Beers\Beer;
use App\Yeasts\Yeast;
use App\Beers\Recipe;
use App\Beers\HopAddition;
use App\Beers\MaltAddition;
use App\Beers\YeastAddition;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'instructions' => $faker->paragraphs(3, true),
        'abv' => $faker->randomDigit,
        'ibu' => $faker->randomNumber(2),
        'og' => '1.0' . $faker->randomNumber(2),
        'fg' => '1.0' . $faker->randomNumber(2),
        'srm' => $faker->numberBetween(1, 20),
        'adjuncts' => $faker->words(8, true),
        'beer_id' => factory(Beer::class),
    ];
});

$factory->afterCreating(Recipe::class, function ($recipe, $faker) {    
    factory(HopAddition::class, 3)->create([
        'recipe_id' => $recipe->id
    ]);
    factory(MaltAddition::class, 2)->create([
        'recipe_id' => $recipe->id
    ]);
    factory(YeastAddition::class, 1)->create([
        'recipe_id' => $recipe->id
    ]);
});
