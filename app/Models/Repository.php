<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $table = 'repositories';
    protected $fillable = [
        'title',    // User given name
        'name',     // Actual repository name on source control
        'user_id',  // User who created this repository
        'owner',    // Owner on source control
        'url'       // Clone URL
    ];

    /**
     * Gets all deployment plans attached to this repository
     */
    public function deploymentPlans()
    {
        return $this->hasMany('App\Models\DeploymentPlan');
    }

    /**
     * Gets the user who created this repository
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
