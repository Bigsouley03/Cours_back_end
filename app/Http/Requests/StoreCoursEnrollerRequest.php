<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoursEnrollerRequest extends FormRequest
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
            "objectifs" => 'required',
            "heureTotal"  => 'required',
            "heureDeroule"  => 'nullable|numeric', // Heure déroulée n'est plus requis, mais doit être numérique s'il est présent.
            "heureRestant"  => 'nullable|numeric',
            "semestre_id"=>'required|exists:semestres,id',
            "classe_id"=>'required|exists:classes,id',
            "professeur_id"=>'required|exists:professeurs,id',
            "module_id"=>'required|exists:modules,id',

        ];
    }
}
