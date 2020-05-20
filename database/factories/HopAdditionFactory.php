<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hops\Hop;
use App\System\Unit;
use App\Hops\HopType;
use App\Beers\Recipe;
use App\Hops\HopMethod;
use App\Beers\HopAddition;
use Faker\Generator as Faker;

$factory->define(HopAddition::class, function (Faker $faker) {
    $hop = Hop::inRandomOrder()->first();
    $method = HopMethod::inRandomOrder()->first();
    $type = HopType::inRandomOrder()->first();
    $unit = Unit::whereIn('symbol', ['g', 'oz'])->inRandomOrder()->first();
    return [
        'hop_id' => $hop->id,
        'recipe_id' => factory(Recipe::class),
        'hop_type_id' => $type->id,
        'hop_method_id' => $method->id,
        'unit_id' => $unit->id,
        'amount' => $faker->numberBetween(5, 200),
        'minute' => $faker->numberBetween(0, 60),
    ];
});
