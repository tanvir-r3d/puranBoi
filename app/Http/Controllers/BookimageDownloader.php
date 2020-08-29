<?php

namespace App\Http\Controllers;


use App\BookImage;

class BookimageDownloader extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function __invoke($id)
    {
        $img=BookImage::findOrFail($id);
        $file_path = public_path('images/book/'.$img->book_image);
        return response()->download($file_path);
    }
}
