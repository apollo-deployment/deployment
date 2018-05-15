<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Main view
     */
    public function index()
    {
        return redirect()->route('view.deployment-plans');
    }

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
     * View for registering a new organization
     */
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('view.index');
        }
        return view('pages.register-organization');
    }

    /**
     * View for user profile
     */
    public function profile()
    {
        if (Auth::user()->is_admin) {
            $users = Auth::user()->organization->users();

            return view('pages.profile', compact('users'));
        }
        return view('pages.profile');
    }
}
