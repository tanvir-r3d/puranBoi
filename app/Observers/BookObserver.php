<?php

namespace App\Observers;

use App\Book;
use Illuminate\Support\Facades\File;

class BookObserver
{
    /**
     * Handle the book "created" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function created(Book $book)
    {
        //
    }

    /**
     * Handle the book "updated" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function updated(Book $book)
    {
        //
    }

    /**
     * Handle the book "deleted" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function deleting(Book $book)
    {
        $book->image()->each(function($img) {
            $path=public_path('images/book/').$img->book_image;
            if(File::exists($path))
                File::delete($path);
        });
    }

    /**
     * Handle the book "restored" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function restored(Book $book)
    {
        //
    }

    /**
     * Handle the book "force deleted" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function forceDeleted(Book $book)
    {
        //
    }
}
