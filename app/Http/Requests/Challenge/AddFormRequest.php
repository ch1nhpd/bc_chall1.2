<?php

namespace App\Http\Requests\Challenge;

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
            'file_upload' => [
                'required',
                'file_extension:txt',
                'max:2048',
            ],
        ];
    }
    public function messages()
    {
        return [
            'file_upload.file_extension' => 'File Input Invalid !!!',
        ];
    }
}
