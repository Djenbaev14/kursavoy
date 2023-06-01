<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGroupPostRequest extends FormRequest
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
            'name' => 'required|unique:groups'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Gruppanıń atın kiritiw shárt',
            'name.unique'=>'Bul gruppa aldın kiritilgen'
        ];
    }
}
