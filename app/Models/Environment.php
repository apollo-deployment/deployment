<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    protected $table = 'environments';
    protected $hidden = ['ssh_username', 'ssh_password', 'private_key_path'];
    protected $fillable = [
        'title',
        'ip_address',
        'ssh_port',
        'authentication_type',  // So we know how to login to the environment
        'ssh_username',
        'ssh_password',
        'private_key_path'      // Local path to private key
    ];

    public function deploymentPlans()
    {
        return $this->hasMany('App\Models\DeploymentPlan');
    }
}
