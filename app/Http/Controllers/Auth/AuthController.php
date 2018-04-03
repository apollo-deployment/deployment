<?php

namespace App\Http\Controllers\Auth;

use App\Apollo\ApolloAPI;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    private $apollo;

    public function __construct()
    {
        $this->apollo = new ApolloAPI;
    }

    /**
     * Check API for existing user, if so log them in
     */
    public function login()
    {
        $data = $this->apollo->login(request());

        if (isset($data->error)) {
            return redirect()->back()->withInput()->withErrors(['login' => 'Incorrect username or password']);
        }

        \Session::put('user', $data);

        return redirect()->route('view.index');
    }

    /**
     * Logout authenticated user
     */
    public function logout()
    {
        \Session::flush();

        return redirect()->route('login');
    }

}
