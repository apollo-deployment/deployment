<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    protected $fillable = [
        'build_number',
        'deployment_plan_id',
        'status'
    ];

    /**
     * Gets the deployment plan this build was for
     */
    public function deploymentPlan()
    {
        return $this->belongsTo(DeploymentPlan::class);
    }
}
