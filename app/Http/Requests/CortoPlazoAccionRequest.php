<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CortoPlazoAccionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //cambiamos a true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'gestion' => ['required', 'digits:4', 'numeric'],
            'accion_corto_plazo' => 'required',
            'resultado_esperado' => ['required', 'numeric', 'max:100'],
            'presupuesto_programado' => ['required', 'numeric'],
            'fecha_inicio' => ['required'],
            'fecha_fin' => ['required']
        ];
    }
}
