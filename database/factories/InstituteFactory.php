<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Institute;
use Faker\Generator as Faker;

$factory->define(Institute::class, function (Faker $faker) {
    return [
        'inst_name'=>$faker->name,
        'inst_details'=>$faker->sentence,
    ];
});
