<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoursEnrollerRequest extends FormRequest
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
            "heureTotal"  => 'required',
            "heureDeroule"  => 'required',
            "heureRestant"  => 'required',
            "semestre_id"=>'required|exists:semestres,id',
            "classe_id"=>'required|exists:classes,id',
            "module_id"=>'required|exists:modules,id',
            "professeur_id"=>'required|exists:professeurs,id'
        ];
    }
}
