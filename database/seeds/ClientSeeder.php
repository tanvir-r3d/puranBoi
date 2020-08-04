<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Client::class, 3)->create()
        ->each(function($client){
            $client->clientdoc()->saveMany(factory(App\ClientDoc::class, 8)->make());
        });
    }
}
