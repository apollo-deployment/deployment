<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = true;

    protected $table = 'projects';
    protected $fillable = ['name', 'repository_url', 'repository_owner', 'repository_name'];

    /**
     * Gets all deployment plans attached to this project
     */
    public function deploymentPlans()
    {
        return $this->hasMany('App\Models\DeploymentPlan');
    }

}
