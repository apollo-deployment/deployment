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
        'deployed_version',   // Which deployed version the project is on
        'is_automatic',       // Whether or not deployment is automatic
        'commands',           // Commands to run during build process
        'env'                 // Environment variables
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

    /**
     * Mutator to decrypt commands
     */
    public function getCommandsAttribute($commands)
    {
        return Crypt::decryptString($commands);
    }

    /**
     * Mutator to decrypt environment variables
     */
    public function getEnvAttribute($env)
    {
        return Crypt::decryptString($env);
    }
}
