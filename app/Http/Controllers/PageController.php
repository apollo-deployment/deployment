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
     * View for user profile
     */
    public function profile()
    {
        return view('pages.profile');
    }

}
