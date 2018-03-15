<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserApp extends Model
{
    protected $table = "users_app";
    protected $fillable = ["nombre", "email", "password", "avatar", "estado", "terminos_condiciones"];
    protected $hidden = ['password'];
    protected $primaryKey = 'id_userapp';

}