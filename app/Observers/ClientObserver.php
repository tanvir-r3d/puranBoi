<?php

namespace App\Observers;

use App\Client;
use Illuminate\Support\Facades\File;

class ClientObserver
{
    /**
     * Handle the client "created" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function created(Client $client)
    {
        //
    }

    /**
     * Handle the client "updated" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function updated(Client $client)
    {
        //
    }

    /**
     * Handle the client "deleted" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function deleting(Client $client)
    {
        $image_path = public_path("images/client/").$client->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $client->clientdoc()->each(function($doc) {
            $path=public_path('docs/client/').$doc->client_doc;
            if(File::exists($path))
            File::delete($path);
        });

    }

    /**
     * Handle the client "restored" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function restored(Client $client)
    {
        //
    }

    /**
     * Handle the client "force deleted" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        //
    }
}
