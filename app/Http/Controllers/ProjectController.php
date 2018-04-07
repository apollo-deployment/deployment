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
     * Store new project
     */
    public function store(ProjectRequest $request)
    {
        $project = Project::create([
            'name' => $request->get('project_name'),
            'repository_url' => $request->get('repository_url'),
        ]);

        return redirect()->back()->withInput()->with(['message' => 'Successfully created project \'' . $project->name . '\'']);
    }

    /**
     * View for updating existing project
     */
    public function edit(Project $project)
    {
        return view('pages.projects.edit', compact('project'));
    }

    /**
     * Update existing DeploymentPlan $plan
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update([
            'name' => $request->get('project_name'),
            'repository_url' => $request->get('repository_url'),
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
