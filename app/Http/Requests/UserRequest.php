<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = $this->route('/user');
        if('_method'=='PUT')
        {
            return [
                'name'=>'required',
                'image'=>'mimes:jpg,jpeg,png|max:2048',
                'email' => 'required|email|unique:users,email,'.$user.',id',
            ];
        }
        else{
            return [
                'name'=>'required',
                'image'=>'mimes:jpg,jpeg,png|max:2048',
                'email' => 'required|email|unique:users,email,'.$user.',id',
                'password' => 'required|min:8',
                'retype' => 'same:password',
            ];
        }
    }
    public function name(){
        return [
            'name'=>'Name',
            'image'=>'Image',
            'email'=>'Email',
            'password'=>'Password',
            'retype'=>'Retype',
        ];
    }
}
