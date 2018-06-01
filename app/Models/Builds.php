<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Builds extends Model
{
    protected $fillable = [
        'deployment_plan_id'
    ];

    /**
     * Gets the deployment plan this build was for
     */
    public function deploymentPlan()
    {
        return $this->belongsTo('App\Models\DeploymentPlan');
    }
}
