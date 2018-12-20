<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class University extends Model
{

    protected $primaryKey = 'codigo';
    protected $table = "universidades";
    protected $fillable = ["codigo","nombre","tipo","sector","caracter_academico","departamento"
        ,"municipio","direccion","direccion_google_maps","telefono","estado","principal_seccional"
        ,"web","logo_universidad"];
    public $timestamps = false;

    public function getSectorAttribute($value) {
        return $value == "OFICIAL" ? "PÚBLICA" : $value;
    }
}