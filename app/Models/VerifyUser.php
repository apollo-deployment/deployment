<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $table = 'verify_users';
    protected $fillable = [
        'user_id',  // User to be verified
        'token'     // Random generated token
    ];

    /**
     * Get user that needs/already has verification
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
