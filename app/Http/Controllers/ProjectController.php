<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreProject;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the projects
//        $projects = Project::all();

        return view('pages.projects.index');//, compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProject $request)
    {
        // store
        Project::create(['name' => $request->get('name'), 'repository_url' => $request->get('repository_url')]);

        // redirect
        Session::flash('message', 'Successfully created project!');
        return Redirect::to('projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the project
        $project = Project::find($id);

        // show the project view and pass in project
        return view('pages.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the project
        $project = Project::find($id);

        // show the edit form and pass in project
        return view('pages.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProject $request, $id)
    {
        // store
        $project = Project::find($id);
        $project->name = $request->get('name');
        $project->repository_url = $request->get('repository_url');
        $project->save();

        // redirect
        Session::flash('message', 'Successfully updated project!');
        return Redirect::to('projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $project = Project::find($id);
        $project->delete();

        // redirect user
        Session::flash('message', 'Successfully deleted the project!');
        return Redirect::to('projects');
    }
}
