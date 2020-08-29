<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $book=$this->route('/book');
        return [
            'book_name' => 'required',
            'book_writter'=>'required',
            'book_dept' => 'required',
            'inst_id'=> 'required',
            'image_type' => 'required',
            'book_purchase_price'=>'required',
            'book_rent_price'=>'required',
            'book_resell_price'=>'required',
            'book_image.*' => 'mimes:jpeg,jpg,png'
        ];
    }
}
