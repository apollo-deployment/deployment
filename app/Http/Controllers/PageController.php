<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * View for user login
     */
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('view.index');
        }
        return view('pages.login');
    }

    /**
     * View for displaying all web servers
     */
    public function webServers()
    {
        return view('pages.web-servers');
    }

    /**
     * View for displaying all repositories
     */
    public function projects()
    {
        return view('pages.repositories');
    }

}
