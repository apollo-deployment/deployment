<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeploymentPlan extends Model
{
    public $timestamps = true;

    protected $table = 'deployment_plans';
    protected $fillable = ['name', 'web_server_id', 'project_id', 'project_branch', 'update_seconds', 'storage_path'];

    /**
     * Gets this plans attached project
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    /**
     * Gets this plans attached web server
     */
    public function webServer()
    {
        return $this->belongsTo('App\Models\WebServer');
    }

}
