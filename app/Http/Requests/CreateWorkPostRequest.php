<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWorkPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'file'=>'required|mimes:doc,docx'
        ];
    }
    public function messages(){
        return [
            'file.required'=>'fayl kiritiw shárt!',
            'file.mimes'=>'fayl túri doc ,docx formatta bolıwı kerek'
        ];
    }
}
