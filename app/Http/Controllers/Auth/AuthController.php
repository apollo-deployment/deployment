<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Attempt login with user credentials
     */
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->get('username'))->firstOrFail();

            if (Hash::check($request->get('password'), $user->password)) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Incorrect username or password']);
            }

            Auth::login($user, true);

            return redirect()->route('view.index');

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Incorrect username or password']);
        }
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
