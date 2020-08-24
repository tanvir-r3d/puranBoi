<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookImage;
use App\BookPrice;
use App\Http\Requests\BookRequest;
use App\Institute;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $books=Book::with('image','price','institute')->get();
//        return response()->json($books);
        return view('Backend.Pages.Book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $institutes=Institute::all();
        return view('Backend.Pages.Book.create',compact('institutes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookRequest $request)
    {
        DB::beginTransaction();
        $requestedData=$request->all();
//        Book Details Data Store
        $book=new Book();
        $book->fill($requestedData)->save();
//        Book Price Data Insert
        $price=new BookPrice();
        Arr::set($requestedData, 'book_id', $book->book_id);
        $price->fill($requestedData)->save();
//        Book Multiple Image Store
        for($i=0;$i<count($request->book_image);$i++)
        {
            $data[]=[
                'book_id' => $book->book_id,
                'image_type'=>$request->image_type[$i],
                'book_image'=> $this->MultiFile($request->book_image[$i],'images/book/','book'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ];
        }
        BookImage::insert($data);
        DB::commit();
        $notification = array(
            'title' => 'Book',
            'message' => 'Successfully! Book Information Saved.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book=Book::whereBookId($id)->with('image','price','institute')->get();
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $delete = Book::findOrFail($id)->delete();

        if($delete)
        {
            $notification = array(
                'title' => 'Book',
                'message' => 'Successfully! Book Information Deleted.',
                'alert-type' => 'success',
            );
        }
        else{
            $notification = array(
                'title' => 'Book',
                'message' => 'Ooh No! Something Went Wrong.',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }
}
