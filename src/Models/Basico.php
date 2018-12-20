<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Basico extends Model
{

    protected $table = "basico_de_conocimiento";
    protected $fillable = ["area_conocimiento", "nombre"];
    public $timestamps = false;

}