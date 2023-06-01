<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentPostRequest extends FormRequest
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
            'name' => 'required',
            'group_id'=>'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password1' => 'required|same:password',
            'photo' => 'required|mimes:jpeg,jpg,png',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Atıńızdı kiritiwińiz shárt',
            'group_id.required' => 'Gruppańızdı kiritiwińiz shárt',
            'email.required' => 'Emailıńızdı kiritiwińiz shárt',
            'password.required' => 'Passport kiritiw shárt',
            'password1.required' => 'Passport kiritiw shárt',
            'password1.same' => 'Paroller sáykes kelmeydi',
            'photo.required' => 'Photo qoyıw shárt',
            'photo.mimes'=>'Fotosúwret maydanında tómendegi túrdegi fayl bolıwı kerek: jpeg, jpg, png.'
        ];
    }
}
