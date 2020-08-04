<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            return [
                'client_name'=>'required',
                'client_gender'=>'required',
                'client_image'=>'mimes:jpg,jpeg,png|max:2048',
                'client_email' => 'required|email',
                'present_address'=>'required',
                'client_dob'=>'required',
                'client_inst'=>'required',
                'client_dept'=>'required',
                'client_doc'=>'mimes:jpg,jpeg,pdf|max:4048'
            ];

    }
    public function name(){
        return [
            'client_name'=>'Name',
            'client_gender'=>'Gender',
            'client_image'=>'Image',
            'client_email' => 'Email',
            'present_address'=>'Present Address',
            'client_dob'=>'Date Of Birth',
            'client_inst'=>'Institute',
            'client_dept'=>'Department',
            'client_doc'=>'Document'
        ];
    }
}
