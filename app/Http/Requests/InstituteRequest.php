<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstituteRequest extends FormRequest
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
        $institute = $this->route('institute');
            return [
                'inst_name'=>"required|unique:institutes,inst_name,".$institute.",inst_id",
            ];
    }
    public function name(){
        return [
            'inst_name'=>'Institute Name',
        ];
    }
}
