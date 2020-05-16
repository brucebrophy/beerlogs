<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Hops\Hop;
use App\Malts\Malt;
use App\Beers\Beer;
use App\Yeasts\Yeast;
use App\Hops\HopType;
use App\Beers\Recipe;
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
    $hops = Hop::inRandomOrder()->limit(3)->get();
    $malts = Malt::inRandomOrder()->limit(3)->get();
    $yeasts = Yeast::inRandomOrder()->limit(1)->get();
    $hop_types = HopType::inRandomOrder()->get();

    $hops->each(function($hop) use ($recipe, $faker, $hop_types) {
         $recipe->hops()->attach([$hop->id => [
            'hop_type_id' => $hop_types->random()->id,
            'grams' => $faker->numberBetween(5, 200),
            'minute' => $faker->numberBetween(0, 60),
         ]]);
    });

    $recipe->malts()->sync($malts);
    $recipe->yeasts()->sync($yeasts);
});
