<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedianoPlazoAccionRequest extends FormRequest
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
            'accion_mediano_plazo' =>'required',
        ];
    }
}
