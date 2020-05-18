<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Malts\Malt;
use App\Beers\Beer;
use App\Yeasts\Yeast;
use App\Beers\Recipe;
use App\Beers\HopAddition;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'instructions' => $faker->paragraphs(3, true),
        'abv' => $faker->randomDigit,
        'ibu' => $faker->randomNumber(2),
        'og' => '1.0' . $faker->randomNumber(2),
        'fg' => '1.0' . $faker->randomNumber(2),
        'adjuncts' => $faker->words(8, true),
        'user_id' => factory(User::class),
        'beer_id' => factory(Beer::class),
    ];
});

$factory->afterCreating(Recipe::class, function ($recipe, $faker) {
    $malts = Malt::inRandomOrder()->limit(3)->get();
    $yeasts = Yeast::inRandomOrder()->limit(1)->get();
    
    factory(HopAddition::class, 3)->create([
        'recipe_id' => $recipe->id
    ]);

    $recipe->malts()->sync($malts);
    $recipe->yeasts()->sync($yeasts);
});
