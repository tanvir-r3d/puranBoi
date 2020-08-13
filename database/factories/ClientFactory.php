<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Client::class, function (Faker $faker) {
    $image=['fb.png','wolf.png','insta.png','avatar.png'];
    return [
        'client_name' => $faker->name,
        'client_gender'=> rand(1,2),
        'client_code'=>rand(999,10000),
        'permanent_address'=>$faker->address,
        'present_address'=>$faker->address,
        'client_dob'=>$faker->date,
        'inst_id'=>factory(\App\Institute::class)->create()->institute_id,
        'client_dept'=>$faker->word,
        'details'=>$faker->sentence,
        'client_email' => $faker->unique()->safeEmail,
        'client_image' => $image[rand(0,3)],
        'client_phone' => $faker->numberBetween($min = 100000, $max = 9999999 ),
    ];
});
