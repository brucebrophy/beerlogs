<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->words(30, true),
        'user_id' => factory(User::class),
    ];
});
