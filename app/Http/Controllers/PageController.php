<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * View for user login
     */
    public function login()
    {
        return view('pages.login');
    }

    /**
     * View for displaying all deployment plans
     */
    public function deployment()
    {
        return view('pages.deployment-plans');
    }

    /**
     * View for displaying all web servers
     */
    public function webServers()
    {
        return view('pages.web-servers');
    }

    /**
     * View for displaying all projects
     */
    public function projects()
    {
        return view('pages.projects');
    }

}
