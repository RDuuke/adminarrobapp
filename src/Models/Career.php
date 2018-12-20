<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = "ies_medellin";

    protected $primaryKey = "codigo_snies";

    public $timestamps = false;

    protected $fillable = ["codigo_institucion","codigo_snies","area_de_conococimiento","basico_de_conocimiento",
        "nombre","nivel_academico","nivel_formacion","metodologia","numero_periodos_de_duracion",
        "periodos_de_duracion","titulo","departamento_oferta_programa",
        "municipio_oferta_programa","costo_matricula","tiempo_admisiones_estudiantes",
    ];

    public function universidad()
    {
        return $this->belongsTo(University::class, "codigo_institucion", "codigo");
    }

    public function basico()
    {
        return $this->belongsTo(Basico::class, "area_de_conococimiento");
    }
}