<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Beers\Hop;
use App\Models\Beers\Beer;
use App\Models\Beers\Recipe;
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

$factory->afterCreating(Recipe::class, function ($beer, $faker) {
    $hops = Hop::inRandomOrder()->limit(3)->get();
    $beer->hops()->sync($hops);
});
