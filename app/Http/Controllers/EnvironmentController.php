<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnvironmentRequest;
use App\Models\Environment;
use Illuminate\Support\Facades\Crypt;

class EnvironmentController extends Controller
{
    /**
     * View for displaying all environments
     */
    public function view()
    {
        return view('pages.environments.view');
    }

    /**
     * View for creating a environment
     */
    public function create()
    {
        return view('pages.environments.create');
    }

    /**
     * View for updating existing environment
     */
    public function edit(Environment $environment)
    {
        return view('pages.environments.edit', compact('environment'));
    }

    /**
     * Store new web server
     */
    public function store(EnvironmentRequest $request)
    {
        // file
        $environment = Environment::create([
            'title' => $request->get('title'),
            'ip_address' => $request->get('ip_address'),
            'ssh_port' => $request->get('ssh_port'),
            'authentication_type' => $request->get('authentication_type'),
            'ssh_username' =>  Crypt::encryptString($request->get('ssh_username')),
            'ssh_password' =>  Crypt::encryptString($request->get('ssh_password')),
        ]);

        return redirect()->route('view.environments')->with(['message' => 'Successfully created environment \'' . $environment->title . '\'']);
    }

    /**
     * Update existing web server
     */
    public function update(EnvironmentRequest $request, Environment $environment)
    {
        $environment->update([
            'title' => $request->get('title'),
            'ip_address' => $request->get('ip_address'),
            'ssh_port' => $request->get('ssh_port'),
            'authentication_type' => $request->get('authentication_type'),
            'ssh_username' =>  Crypt::encryptString($request->get('ssh_username')),
            'ssh_password' =>  Crypt::encryptString($request->get('ssh_password')),
        ]);

        return redirect()->route('view.environments')->with(['message' => 'Successfully updated web environment \'' . $environment->title . '\'']);
    }

    /**
     * Delete existing project
     */
    public function delete(Environment $environment)
    {
        if ($environment->deploymentPlans()) {
            return redirect()->route('view.environments')->withErrors('Unable to delete. There are active deployment plans running on this environment');
        }
        $environment->delete();

        return redirect()->route('view.environments')->with(['message' => 'Successfully deleted environment']);
    }

}
