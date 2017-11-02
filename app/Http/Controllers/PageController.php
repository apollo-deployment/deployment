<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    // Initial page
    public function index()
    {
        return view('pages.index');
    }

}
