<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Attempt login with user credentials
     */
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->get('email'))->firstOrFail();

            // Check if account is verified
            if (! $user->verified) {
                return redirect()->route('view.login')->withErrors('Please verify your email before logging in');
            }

            // Check users password
            if ($user && Hash::check($request->get('password'), $user->password)) {
                Auth::login($user, (boolean) $request->get('remember_me'));

                return redirect()->route('view.index');
            }

            return redirect()->back()->withInput()->withErrors('Incorrect username or password');

        } catch (ModelNotFoundException $e) {
            return redirect()->route('view.login')->withErrors("An account with that email doesn't exist");
        }
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
     * Google OAuth callback. Creates new user if they don't exist
     */
    public function googleCallback()
    {
        $google_user = $this->socialite()->user();

        try {
            $user = User::where('email', $google_user->email)->firstOrFail();

            // Check if account is verified
            if (! $user->verified) {
                return redirect()->route('view.login')->withErrors('Please verify your email before logging in');
            }

            Auth::login($user, true);

        } catch (ModelNotFoundException $e) {
            return redirect()->route('view.login')->withErrors("This account doesn't exist");
        }

        return redirect()->route('view.index');
    }

    /**
     * Redirect to Google OAuth login
     */
    public function redirectToGoogle()
    {
        return \Socialite::driver('google')->redirect();
    }

    /**
     * Logout authenticated user
     */
    public function logout()
    {
        Auth::logout();
        session()->flush();

        return redirect()->route('login');
    }
}
