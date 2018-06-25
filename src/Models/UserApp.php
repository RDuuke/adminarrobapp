<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserApp extends Model
{
    protected $table = "users_api";
    protected $fillable = ["name", "email", "encrypted_password", "salt", "avatar", "estado", "terminos_condiciones"];
    protected $hidden = ['password'];
    protected $primaryKey = 'id';

}
