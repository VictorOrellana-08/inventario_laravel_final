<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubirFotosDeArticulosRequest extends FormRequest
{
    //Determinar si el usuario está autorizado para realizar esta solicitud.
    public function authorize()
    {
        return true;
    }

    //Obtenga las reglas de validación que se aplican a la solicitud.
    public function rules()
    {
        return [
            "fotos" => "required|array",
            "fotos.*" => "required|image|mimes:jpeg,png|max:3000",
            "id" => "required|numeric|exists:articulos,id"
        ];
    }
}
