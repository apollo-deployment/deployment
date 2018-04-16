<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebServerRequest;
use App\Models\WebServer;
use Illuminate\Support\Facades\Crypt;

class WebServerController extends Controller
{
    /**
     * View for displaying all web servers
     */
    public function view()
    {
        return view('pages.web_servers.view');
    }

    /**
     * View for creating a web server
     */
    public function create()
    {
        return view('pages.web_servers.create');
    }

    /**
     * View for updating existing web server
     */
    public function edit(WebServer $web_server)
    {
        return view('pages.web_servers.edit', compact('web_server'));
    }

    /**
     * Store new web server
     */
    public function store(WebServerRequest $request)
    {
        // file
        $web_server = WebServer::create([
            'name' => $request->get('name'),
            'ip_address' => $request->get('ip_address'),
            'ssh_port' => $request->get('ssh_port'),
            'authentication_type' => $request->get('authentication_type'),
            'ssh_username' =>  Crypt::encryptString($request->get('ssh_username')),
            'ssh_password' =>  Crypt::encryptString($request->get('ssh_password')),
        ]);

        return redirect()->route('view.web_servers')->with(['message' => 'Successfully created web server \'' . $web_server->name . '\'']);
    }

    /**
     * Update existing web server
     */
    public function update(WebServerRequest $request, WebServer $web_server)
    {
        return redirect()->route('view.web_servers')->with(['message' => 'Successfully updated web server \'' . $web_server->name . '\'']);
    }

    /**
     * Delete existing project
     */
    public function delete(WebServer $web_server)
    {
        $web_server->delete();

        return redirect()->route('view.web_servers')->with(['message' => 'Successfully deleted web server']);
    }

}
