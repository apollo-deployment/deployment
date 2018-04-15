<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * View for displaying all projects
     */
    public function view()
    {
        return view('pages.projects.view');
    }

    /**
     * View for creating a project
     */
    public function create()
    {
        return view('pages.projects.create');
    }

    /**
     * View for updating existing project
     */
    public function edit(Project $project)
    {
        return view('pages.projects.edit', compact('project'));
    }

    /**
     * Store new project
     */
    public function store(ProjectRequest $request)
    {
        $repo_info = explode('/', explode('github.com/', $request->get('repository_url'))[1]);

        $project = Project::create([
            'name' => $request->get('name'),
            'repository_url' => $request->get('repository_url'),
            'repository_owner' => $repo_info[0],
            'repository_name' => explode('.git', $repo_info[1])[0],
        ]);

        return redirect()->route('view.projects')->with(['message' => 'Successfully created project \'' . $project->name . '\'']);
    }

    /**
     * Update existing DeploymentPlan $plan
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $repo_info = explode('/', explode('github.com/', $request->get('repository_url'))[1]);

        $project->update([
            'name' => $request->get('name'),
            'repository_url' => $request->get('repository_url'),
            'repository_owner' => $repo_info[0],
            'repository_name' => explode('.git', $repo_info[1])[0],
        ]);

        return redirect()->back()->withInput()->with(['message' => 'Successfully updated project \'' . $project->name . '\'']);
    }

    /**
     * Delete existing project
     */
    public function delete(Project $project)
    {
        $project->delete();

        return redirect()->back()->with(['message' => 'Successfully deleted project']);
    }

}
