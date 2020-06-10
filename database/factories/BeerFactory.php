<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\User;
use App\Comment;
use App\Beers\Beer;
use App\Beers\Style;
use App\Beers\Recipe;

$factory->define(Beer::class, function (Faker $faker) {
    $name = $faker->words(2, true);
    $style = Style::inRandomOrder()->limit(1)->first();
    return [
        'name' => $name,
        'notes' => $faker->words(12, true),
        'description' => $faker->words(100, true),
        'style_id' => $style->id,
        'user_id' => factory(User::class),
    ];
});

$factory->afterCreating(Beer::class, function ($beer, $faker) {    
    factory(Recipe::class)->create([
        'beer_id' => $beer->id,
        'user_id' => $beer->user_id,
    ]);

    $beer->comments()->saveMany(factory(Comment::class, 5)->make());
});