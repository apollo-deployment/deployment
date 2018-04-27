<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    public $timestamps = true;

    protected $table = 'repositories';
    protected $fillable = [
        'title',    // User given name
        'name',     // Actual repository name on source control
        'user_id',  // User who created this repository
        'owner',    // Owner on source control
        'url'       // Clone URL
    ];

    /**
     * Gets all deployment plans attached to this project
     */
    public function deploymentPlans()
    {
        return $this->hasMany('App\Models\DeploymentPlan');
    }

}
