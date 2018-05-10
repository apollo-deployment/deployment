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
        'organization_id',      // A way to separate users
        'is_verified',             // Whether this user is verified or not
        'is_admin',             // If user is an admin of their organization
    ];

    /**
     * Gets the organization this user belongs to
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    /**
     * Get whether this user is verified
     */
    public function verifyUser()
    {
        return $this->hasOne('App\Models\VerifyUser');
    }
}
