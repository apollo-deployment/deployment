<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnvironmentRequest;
use App\Models\Environment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class EnvironmentController extends Controller
{
    /**
     * View for displaying all environments
     */
    public function view()
    {
        $environments = Environment::where('organization_id', Auth::user()->organization_id)->get();

        return view('pages.environments.view', compact('environments'));
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
        if ($request->hasFile('private_key')) {
            $file = $request->file('private_key');
            $file_name = time() . '.' . $file->getClientOriginalExtension();

            Storage::putFileAs('ssh_keys', $file, $file_name);
        }

        $environment = Environment::create([
            'organization_id' => Auth::user()->organization_id,
            'title' => $request->get('title'),
            'ip_address' => $request->get('ip_address'),
            'ssh_port' => $request->get('ssh_port'),
            'authentication_type' => $request->get('authentication_type'),
            'ssh_username' =>  Crypt::encryptString($request->get('ssh_username')),
            'ssh_password' =>  Crypt::encryptString($request->get('ssh_password')),
            'private_key_path' => isset($file_name) ? $file_name : null
        ]);

        return redirect()->route('view.environments')->with(['message' =>"Successfully created environment '{$environment->title}'"]);
    }

    /**
     * Update existing web server
     */
    public function update(Environment $environment, EnvironmentRequest $request)
    {
        if ($request->hasFile('private_key')) {
            $file = $request->file('private_key');
            $file_name = str_random(10) . '.' . $file->getClientOriginalExtension();

            Storage::putFileAs('ssh_keys', $file, $file_name);

            if ($environment->private_key_path) {
                Storage::delete("ssh_keys/{$environment->private_key_path}");
            }
        }

        $environment->update([
            'title' => $request->get('title'),
            'ip_address' => $request->get('ip_address'),
            'ssh_port' => $request->get('ssh_port'),
            'authentication_type' => $request->get('authentication_type'),
            'ssh_username' =>  Crypt::encryptString($request->get('ssh_username')),
            'ssh_password' =>  Crypt::encryptString($request->get('ssh_password')),
            'private_key_path' => isset($file_name) ? $file_name : null
        ]);

        return redirect()->route('view.environments')->with(['message' => "Successfully updated web environment  '{$environment->title}'"]);
    }

    /**
     * Delete existing project
     */
    public function delete(Environment $environment)
    {
        if ($environment->deploymentPlans()->get()->count() > 0) {
            return redirect()->route('view.environments')->withErrors('Unable to delete. There are active deployment plans running on this environment');
        }
        $environment->delete();

        return redirect()->route('view.environments')->with(['message' => 'Successfully deleted environment']);
    }
}
