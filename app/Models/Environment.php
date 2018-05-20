<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
