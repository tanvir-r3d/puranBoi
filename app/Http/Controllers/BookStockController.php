<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\BookCode;
use App\BookImage;
class BookStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $books=Book::all();
        return view('Backend.Pages.Book.Stock.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books=Book::all();
        return view('Backend.Pages.Book.Stock.create',compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book_unique_codes=array_filter($request->book_unique_code, static function($var){return $var !== null;});
        if (count($book_unique_codes)==$request->book_quantity)
        {
            $book=Book::find($request->book);
            $book->book_quantity=$request->book_quantity;
            $book->save();

            foreach(($book_unique_codes) as $v)
            {
                $data[]=[
                    'book_unique_code'=>$v,
                    'book_id'=>$request->book];
            }
            BookCode::insert($data);

            $notification = array(
                'title' => 'Book Stock',
                'message' => 'Successfully! Book Stock Updated.',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }
        else
        {
            $notification = array(
                'title' => 'Book Stock',
                'message' => 'Oops! Must give all unique code.',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
