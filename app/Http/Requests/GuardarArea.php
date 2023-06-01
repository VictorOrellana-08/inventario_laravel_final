<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarArea extends FormRequest
{
    //Determinar si el usuario está autorizado para realizar esta solicitud
    public function authorize()
    {
        return true;
    }

    //Reglas de validación que se aplican a la solicitud.
    public function rules()
    {
        return [
            "nombre" => "required|max:255"
        ];
    }
}
