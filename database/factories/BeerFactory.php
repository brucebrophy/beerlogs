<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\User;

use App\Models\Beers\Beer;
use App\Models\Beers\Style;

$factory->define(Model::class, function (Faker $faker) {
    $name = $faker->words(2);
    $style = Style::first();
    $user = User::first();
    
    return [
        'name' => $faker->words(2),
        'slug' => Str::slug($name),
        'notes' => $faker->words(12),
        'description' => $faker->words(100),
        'style_id' => $style->id,
        'user_id' => factory(User::class),
    ];
});
