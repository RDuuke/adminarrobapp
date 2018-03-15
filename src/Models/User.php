<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    protected $table = "users";
    protected $fillable = ["name", "email", "password", "rol_id"];
    protected $hidden = ['password'];
    protected $primaryKey = 'id';

}