<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubjectPostRequest extends FormRequest
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
            'name' => 'required|unique:subjects'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Tarawdıń atın kiritiw shárt',
            'name.unique'=>'Bul taraw aldın kiritilgen'
        ];
    }
}
