<?php

namespace App\Http\Controllers\Api;

use App\Api\GitHub;
use App\Http\Controllers\Controller;
use App\Models\Repository;

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
        $repository = Repository::find(request('project_id'));

        // return $this->github->getBranches();
    }

}
