<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserApp extends Model
{
    protected $table = "users_app";
    protected $fillable = ["nombres", "email", "encrypted_password", "salt", "estado", "terminos_condiciones"];
    protected $hidden = ['password'];
    protected $primaryKey = 'id';
}
