<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Environment extends Model
{
    protected $table = 'environments';
    protected $fillable = [
        'organization_id',
        'title',
        'ip_address',
        'ssh_port',
        'authentication_type',  // So we know how to login to the environment
        'ssh_username',
        'ssh_password',
        'private_key_path'      // Local path to private key
    ];

    /**
     * Gets all the deployment plans building on this environment
     */
    public function deploymentPlans()
    {
        return $this->hasMany('App\Models\DeploymentPlan');
    }

    /**
     * Gets the organization it belongs to
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    /**
     * Mutator to decrypt SSH username
     */
    public function getSshUsernameAttribute($username)
    {
        return isset($username) ? Crypt::decryptString($username) : null;
    }

    /**
     * Mutator to decrypt SSH password
     */
    public function getSshPasswordAttribute($password)
    {
        return isset($password) ? Crypt::decryptString($password) : null;
    }
}
