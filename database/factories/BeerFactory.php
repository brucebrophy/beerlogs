<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\User;
use App\Beers\Beer;
use App\Beers\Style;

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
