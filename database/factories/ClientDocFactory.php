<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ClientDoc;
use App\Client;
use Faker\Generator as Faker;

$factory->define(ClientDoc::class, function (Faker $faker) {
    return [
        'client_id'=>factory(Client::class)->create()->client_id,
        'client_doc'=>$faker->name,
        'doc_type'=>$faker->mimeType,
    ];
});
