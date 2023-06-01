<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCheckPostRequest extends FormRequest
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
            'score'=>'required|numeric|min:2|max:5'
        ];
    }
    public function messages(){
        return [
            'score.required'=>'ball qoyıw kerek',
            'score.numeric'=>'cifr bolıw kerek',
            'score.min'=>'eń tómen baxa 2',
            'score.max'=>'eń joqarı baxa 5',
        ];
    }
}
