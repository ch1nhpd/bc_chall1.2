<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AddFormRequest extends FormRequest
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
            'fullname' => 'required|max:255',
            'username' => 'required|min:5|max:255|alpha_dash',
            'password' => 'required|min:5|max:255',
            'email' => 'required|email',
            'phonenumber' => 'required|digits:10',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'fullname.required' => 'Full name is required',
    //         'body.required'  => 'A message is required',
    //     ];
    // }
}
