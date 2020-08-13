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
        $client=$this->route('/client');
            return [
                'client_name' => 'required',
                'client_code' => 'required|unique:clients,client_code,'.$client.',client_id',
                'client_image'=> 'mimes:jpg,jpeg,png|max:3048',
                'client_email' => 'required|email|unique:clients,client_email,'.$client.',client_id',
                'present_address' => 'required',
                'client_dob' => 'required|date',
                'inst_id' => 'required',
                'client_dept' => 'required',
                'client_doc.*' => 'mimes:jpeg,jpg,png,doc,docx,pdf,zip'
            ];

    }
    public function name(){
        return [
            'client_name'=>'Name',
            'client_code'=>'Code',
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
