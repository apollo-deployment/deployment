<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeploymentPlan extends Model
{
    public $timestamps = true;

    protected $table = 'deployment_plans';
    protected $fillable = ['name', 'web_server_id', 'project_id', 'project_branch', 'update_seconds', 'storage_path'];

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
