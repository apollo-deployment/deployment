<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepositoryRequest;
use App\Models\Repository;

class RepositoryController extends Controller
{
    /**
     * View for displaying all repositories
     */
    public function view()
    {
        return view('pages.repositories.view');
    }

    /**
     * View for creating a Repository
     */
    public function create()
    {
        return view('pages.repositories.create');
    }

    /**
     * View for updating existing Repository
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
        $repository = Repository::create([
            'name' => $request->get('name'),
            'url' => $request->get('url'),
        ]);

        return redirect()->route('view.repositories')->with(['message' => 'Successfully created repository \'' . $repository->name . '\'']);
    }

    /**
     * Update existing DeploymentPlan $plan
     */
    public function update(RepositoryRequest $request, Repository $repository)
    {
        $repository->update([
            'name' => $request->get('name'),
            'url' => $request->get('url'),
        ]);

        return redirect()->route('view.repositories')->with(['message' => 'Successfully updated repository \'' . $repository->name . '\'']);
    }

    /**
     * Delete existing Repository
     */
    public function delete(Repository $repository)
    {
        $repository->delete();
        $repository->deploymentPlans->delete();

        return redirect()->route('view.repositories')->with(['message' => 'Successfully deleted repository']);
    }

}
