<?php

namespace App\Http\Controllers;

use App\BookImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookimageDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $img=BookImage::findOrFail($id);
        if($img->book_image)
        {
            $path=public_path("images/book/").$img->book_image;
            if (File::exists($path))
            {
                File::delete($path);
            }
        }
        $delete=$img->delete();
        if($delete)
        {
            $notification = array(
                'title' => 'Book Image',
                'message' => 'Successfully! Book image Deleted.',
                'alert-type' => 'success',
            );
        }
        else{
            $notification = array(
                'title' => 'Book image',
                'message' => 'Ooh No! Something Went Wrong.',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }
}
