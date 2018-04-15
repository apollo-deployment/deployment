<?php

namespace App\Http\Controllers\Api;

use App\Api\GitHub;
use App\Http\Controllers\Controller;
use App\Models\Project;

class GitHubController extends Controller
{
    private $github;

    public function __construct()
    {
        $this->github = new GitHub;
    }

    /**
     * Gets all branches for a repo. Splits repo URL to get repo owner & name
     */
    public function getBranches()
    {
        $project = Project::find(request('project_id'));

        return $this->github->getBranches($project->repository_owner, $project->repository_name);
    }

}
