<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PilarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //////////////////////////// debemos cambiar a true el valor para que nos funciones el request
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
            'nombre_pilar' => 'required|string',
            'gestion_pilar' => 'required|numeric|max:9999',
        ];
    }
}
