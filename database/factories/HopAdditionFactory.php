<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hops\Hop;
use App\Hops\HopType;
use App\Beers\Recipe;
use App\Beers\HopAddition;
use Faker\Generator as Faker;

$factory->define(HopAddition::class, function (Faker $faker) {
    $hop = Hop::inRandomOrder()->limit(1)->get()->first();
    $type = HopType::inRandomOrder()->limit(1)->get()->first();
    return [
        'hop_id' => $hop->id,
        'recipe_id' => factory(Recipe::class),
        'hop_type_id' => $type->id,
        'amount' => $faker->numberBetween(5, 200),
        'minute' => $faker->numberBetween(0, 60),
    ];
});
