<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class DeploymentPlan extends Model
{
    protected $table = 'deployment_plans';
    protected $fillable = [
        'organization_id',
        'title',
        'environment_id',
        'repository_id',
        'repository_branch',
        'build_id',           // Which build the project is on
        'status',
        'is_automatic',       // Whether or not deployment is automatic
        'commands',           // Commands to run during build process
        'env'                 // Environment variables
    ];

    /**
     * Gets the organization this belongs to
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

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

    /**
     * Gets all the builds for this deployment plan
     */
    public function builds()
    {
        return $this->hasMany('App\Models\Build');
    }

    /**
     * Mutator to decrypt commands
     */
    public function getCommandsAttribute($commands)
    {
        return isset($commands) ? Crypt::decryptString($commands) : null;
    }

    /**
     * Mutator to decrypt environment variables
     */
    public function getEnvAttribute($env)
    {
        return isset($env) ? Crypt::decryptString($env) : null;
    }
}
