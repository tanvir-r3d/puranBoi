<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookCodeRequest extends FormRequest
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
        $book_code=$this->route('/book_stock');
        return [
            'book_unique_code.*'=>'required|unique:book_codes,book_unique_code,'.$book_code.',book_code_id',
        ];
    }
}
