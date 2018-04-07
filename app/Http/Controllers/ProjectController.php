<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.projects.index');
    }

    /**
     * Show the form for creating a new project
     */
    public function create()
    {
        return view('pages.projects.create');
    }

    /**
     * Store a newly created project
     */
    public function store(ProjectRequest $request)
    {
        Project::create([
            'name' => $request->get('name'),
            'repository_url' => $request->get('repository_url')
        ]);

        return Redirect::to('projects')->with(['message', 'Successfully created project ' . $request->get('name')]);
    }

    /**
     * Display the specified project
     */
    public function show($id)
    {
        $project = Project::find($id);

        return view('pages.projects.show', compact('project'));
    }

    /**
     * Finds project to edit & returns edit view
     */
    public function edit($id)
    {
        $project = Project::find($id);

        return view('pages.projects.edit', compact('project'));
    }

    /**
     * Update existing project
     */
    public function update(ProjectRequest $request, $id)
    {
        Project::find($id)->update([
            'name' => $request->get('name'),
            'repository_url' => $request->get('repository_url')
        ]);

        return Redirect::to('projects')->with(['message', 'Successfully updated project ' . $request->get('name')]);
    }

    /**
     * Removes project with $id
     */
    public function destroy($id)
    {
        Project::find($id)->delete();

        return Redirect::to('projects')->with(['message', 'Successfully deleted project']);
    }

}
