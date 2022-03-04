<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //campos donde comparamos los que se envia por el formulario
        //'email' => 'required',
        //'name' => 'required',
        'usuario' => 'required',   
        'password' => 'required'
        ];
    }
}
