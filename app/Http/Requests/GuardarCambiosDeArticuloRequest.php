<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarCambiosDeArticuloRequest extends FormRequest
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
            "id" => "required|numeric|exists:articulos,id",
            "fechaAdquisicion" => "required|date_format:Y-m-d",
            "codigo" => "required|max:255",
            "numeroFolioComprobante" => "max:255",
            "descripcion" => "required|max:255",
            "estado" => "required|in:regular,malo,inservible,noEncontrado",
            "observaciones" => "max:255",
            "costoAdquisicion" => "required|numeric|between:1,99999999.99",
            "areas_id" => "required|exists:areas,id",//Requerido y que exista en áreas, columna id :)
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
