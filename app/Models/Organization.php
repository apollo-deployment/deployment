<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Organization extends Model
{
    protected $table = 'organizations';
    protected $fillable = [
        'title'
    ];

    /**
     * Gets all users in this organization
     */
    public function users()
    {
        return $this->hasMany('App\Models\User')
                    ->where('id', '!=', Auth::id())
                    ->orderBy('is_admin', 'desc')->get();
    }

    /**
     * Gets all repositories owned by this organization
     */
    public function repositories()
    {
        return $this->hasManyThrough('App\Models\Repository', 'App\Models\User')->get();
    }
}
