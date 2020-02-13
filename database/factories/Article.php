<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title'  =>  $faker->sentence(10),
        'description'   =>  $faker->realText(50),
        'author' => $faker->sentence(12)
    ];
});
