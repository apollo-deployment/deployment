<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeploymentPlan extends Model
{
    protected $table = 'deployment_plans';
    protected $fillable = [
        'organization_id',
        'title',
        'environment_id',
        'repository_id',
        'repository_branch',
        'deployed_version',   // Hash on which deployed version the project is on
        'is_automatic',       // Whether or not deployment is automatic
        'remote_path'         // Remote path on the environment where project is stored
    ];

    /**
     * Gets this plans attached repository
     */
    public function repository()
    {
        return $this->belongsTo('App\Models\Repository');
    }

    /**
     * Gets this plans attached environment
     */
    public function environment()
    {
        return $this->belongsTo('App\Models\Environment');
    }
}
