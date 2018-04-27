<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    public $timestamps = true;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'access_token', 'organization'];
    protected $hidden = ['password'];
}
