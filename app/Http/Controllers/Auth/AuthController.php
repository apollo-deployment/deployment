<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
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
        $user = User::where('email', $request->get('email'))->first();

        if ($user && Hash::check($request->get('password'), $user->password)) {
            Auth::login($user, true);

            return redirect()->route('view.index');
        }

        return redirect()->back()->withInput()->withErrors('Incorrect username or password');
    }

    /**
     * Updates user profile
     */
    public function updateProfile(ProfileRequest $request)
    {
        Auth::user()->update([
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ]);

        return redirect()->route('view.profile')->with(['message' => 'Successfully updated your profile']);
    }

    /**
     * Update user password
     */
    public function updatePassword(PasswordRequest $request)
    {
        if (Hash::check($request->get('current_password'), Auth::user()->password)) {
            Auth::user()->update([
                'password' => Hash::make($request->get('password'))
            ]);

            return redirect()->route('view.profile')->with(['message-password' => 'Successfully updated password']);
        }

        return redirect()->back()->withErrors(['current_password' => 'Incorrect password']);
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
