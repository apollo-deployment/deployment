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
    protected $hidden = ['password'];
    protected $fillable = [
        'name',
        'email',
        'password',             // Nullable with OAuth
        'github_access_token',  // Password like token to get access on GitHub
        'organization'          // A way to separate users
    ];
}
