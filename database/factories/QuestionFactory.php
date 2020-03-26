<?php

use App\Models\Question;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Question::class, function (Faker $faker) {
    return [
        'content' => $faker->text(),
    ];
});
