<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public $timestamps = true;

    protected $table = 'organizations';
    protected $fillable = [
        'title'
    ];

    /**
     * Gets all users in this organization
     */
    public function users()
    {
        return $this->hasMany('App\Models\User')->orderBy('is_admin', 'desc')->get();
    }
}
