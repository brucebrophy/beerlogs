<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Malts\Malt;
use App\Beers\Beer;
use App\System\Unit;
use App\Yeasts\Yeast;
use App\Beers\Recipe;
use App\Beers\HopAddition;
use App\Beers\MaltAddition;
use App\Beers\YeastAddition;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'instructions' => $faker->paragraphs(5, true),
        'abv' => $faker->randomDigit,
        'ibu' => $faker->randomNumber(2),
        'og' => '1.0' . $faker->numberBetween(40, 50),
        'fg' => '1.0' . $faker->numberBetween(10, 15),
        'srm' => $faker->numberBetween(1, 20),
        'batch_size' => $faker->numberBetween(1, 5),
        'adjuncts' => $faker->words(8, true),
        'unit_id' => Unit::where('symbol', 'gal')->first()->id,
        'beer_id' => factory(Beer::class),
        'user_id' => factory(User::class),
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
