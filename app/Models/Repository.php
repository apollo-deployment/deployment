<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    public $timestamps = true;

    protected $table = 'repositories';
    protected $fillable = ['name', 'url'];

    /**
     * Gets all deployment plans attached to this project
     */
    public function deploymentPlans()
    {
        return $this->hasMany('App\Models\DeploymentPlan');
    }

}
