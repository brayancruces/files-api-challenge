<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class DeleteFileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           // 'preserve_file' => 'in:true,false'
        ];
    }


    public function failedValidation(Validator $validator)
    {   
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Error en algunos campos',
            'errors'      => $validator->errors()
        ]));
    }
}
