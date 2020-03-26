<?php

use App\Models\Exam;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Exam::class, function (Faker $faker) {
    return [
    	'name' => $faker->name,
    ];
});
