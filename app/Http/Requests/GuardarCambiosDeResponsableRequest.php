<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarCambiosDeResponsableRequest extends FormRequest
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
            "nombre" => "required|max:255",
            "direccion" => "required|max:255",
            "id" => "required|numeric|exists:responsables,id",
            "areas_id" => "required|numeric|exists:areas,id",//Requerido y que exista en áreas, columna id :)
        ];
    }

    //Devuelve la matriz de datos JSON.
    public function all($keys = null)
    {
        if (empty($keys)) {

            //proporciona una representación de los datos JSON
            return parent::json()->all();
        }

        return collect(parent::json()->all())->only($keys)->toArray();
    }
}
