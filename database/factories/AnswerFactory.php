<?php

use App\Models\Answer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Answer::class, function (Faker $faker) {
    return [
    	'content' => $faker->text(60),
    	'correct' => $faker->boolean,
    ];
});
