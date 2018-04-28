<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Attempt login with user credentials
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->get('username'))->first();

        if ($user && Hash::check($request->get('password'), $user->password)) {
            Auth::login($user, true);

            return redirect()->route('view.index');
        }

        return redirect()->back()->withInput()->withErrors('Incorrect username or password');
    }

    /**
     * Logout authenticated user
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

}
