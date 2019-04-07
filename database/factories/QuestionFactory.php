<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Question::class, function (Faker $faker) {
    $title = $faker->sentence();
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => $faker->text,
        'category_id' => function () {
            return \App\Category::all()->random();
        },
        'user_id' => function () {
            return \App\User::all()->random();
        }
    ];
});
