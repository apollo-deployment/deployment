<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeploymentPlan extends Model
{
    public $timestamps = true;

    protected $table = 'deployment_plans';
    protected $fillable = ['name', 'web_server_id', 'project_id', 'project_branch', 'update_seconds', 'storage_path'];
}
