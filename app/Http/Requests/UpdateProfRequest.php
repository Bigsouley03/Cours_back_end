<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            "name" => 'required',
            "email"  => 'required',
            "password"  =>'required',
            "adresse"=>'nullable',
            "specialite"=>'nullable',
            "id"=>'required|exists:professeurs,id',
            "user_id"=>'required|exists:users,id'
        ];
    }
}
