<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuario extends FormRequest
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
        if(request()->isMethod('POST')){
            $usuarioRule = ['required'];
        }
        elseif(request()->isMethod('PUT') || request()->isMethod('PATH')){
            $usuarioRule = ['']; //si el metodo es put o path no el usuario no sera requerido
        }
        return [
            'trabajador_id' => $usuarioRule,
            'password' => ['required'],
            // 'roles' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'trabajador_id.required' => 'El campo usuario es obligatorio',
        ];
    }
    
}
