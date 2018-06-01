<?php

namespace App\Http\Controllers;

use App\Api\GitHub;
use App\Http\Requests\RepositoryRequest;
use App\Models\Repository;
use Illuminate\Support\Facades\Auth;

class RepositoryController extends Controller
{

    private $github;

    public function __construct()
    {
        $this->github = new GitHub;
    }

    /**
     * View for displaying all repositories
     */
    public function view()
    {
        return view('pages.repositories.view');
    }

    /**
     * View for creating a repository
     */
    public function create()
    {
        return view('pages.repositories.create');
    }

    /**
     * View for updating existing repository
     */
    public function edit(Repository $repository)
    {
        return view('pages.repositories.edit', compact('repository'));
    }

    /**
     * Store new Repository
     */
    public function store(RepositoryRequest $request)
    {
        $repo_info = explode('/', explode('github.com/', $request->get('url'))[1]);

        $repository = Repository::create([
            'title' => $request->get('title'),
            'name' => explode('.git', $repo_info[1])[0],
            'user_id' => Auth::id(),
            'owner' => $repo_info[0],
            'url' => $request->get('url')
        ]);

        return redirect()->route('view.repositories')->with(['message' => 'Successfully created repository \'' . $repository->title . '\'']);
    }

    /**
     * Update existing DeploymentPlan $plan
     */
    public function update(RepositoryRequest $request, Repository $repository)
    {
        $repo_info = explode('/', explode('github.com/', $request->get('url'))[1]);

        $repository->update([
            'title' => $request->get('title'),
            'name' => explode('.git', $repo_info[1])[0],
            'owner' => $repo_info[0],
            'url' => $request->get('url'),
        ]);

        return redirect()->route('view.repositories')->with(['message' => 'Successfully updated repository \'' . $repository->title . '\'']);
    }

    /**
     * Delete existing repository
     */
    public function delete(Repository $repository)
    {
        $repository->deploymentPlans()->delete();
        $repository->delete();

        return redirect()->route('view.repositories')->with(['message' => 'Successfully deleted repository']);
    }
}
