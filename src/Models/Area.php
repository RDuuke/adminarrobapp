<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "area_de_conocimiento";
    protected $fillable = ["nombre"];
    public $timestamps = false;
}