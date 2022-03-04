<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanificacionRequest extends FormRequest
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
            '1er_trimestre' => ['sometimes', 'required'],
            '2do_trimestre' => ['sometimes', 'required'],
            '3er_trimestre' => ['sometimes', 'required'],
            '4to_trimestre' => ['sometimes', 'required']
        ];
    }
}
