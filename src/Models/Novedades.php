<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Novedades extends Model
{
    protected $table = "novedades";
    protected $fillable = ["imagen", "titulo", "contenido", "resumen", "link", "tipo_novedad", "created_at", "updated_at", "miniatura", "imagen"];
    protected $primaryKey = 'id_novedad';

}