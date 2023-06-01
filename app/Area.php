<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //Específica el nombre de la tabla en la DB.
    protected $table = "areas";

    //Relación de UNO a UNO.
    public function responsable()
    {
        return $this->hasOne("App\Responsable", "id");
    }
}
