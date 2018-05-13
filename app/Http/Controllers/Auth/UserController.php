<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Mail\EmailVerification;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Attempt login with user credentials
     */
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->get('email'))->firstOrFail();

            // Check if account is verified
            if (! $user->is_verified) {
                $token = $user->verifyUser()->first()->token;
                return redirect()->route('view.login')->with('token', $token)->withErrors('Please verify your email before logging in.');
            }

            // Check users password
            if ($user && Hash::check($request->get('password'), $user->password)) {
                Auth::login($user, (boolean)$request->get('remember_me'));

                return redirect()->route('view.index');
            }

            return redirect()->back()->withInput()->withErrors('Incorrect username or password');

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withInput()->withErrors('Incorrect username or password');
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
     * AJAX : Updates users avatar image
     */
    public function updateAvatar(Request $request)
    {
        if ($request->hasFile('avatar_upload')) {
            $file = $request->file('avatar_upload');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/images/avatars'), $file_name);

            if (Auth::user()->avatar) {
                \File::delete(public_path('/images/avatars') . '/' . Auth::user()->avatar);
            }

            Auth::user()->update([
               'avatar' => $file_name
            ]);

            return url('/images/avatars') . '/' . $file_name;
        }
    }

    /**
     * Google OAuth callback. Creates new user if they don't exist
     */
    public function googleCallback()
    {
        $google_user = \Socialite::driver('google')->user();

        try {
            $user = User::where('email', $google_user->email)->firstOrFail();

            // Check if account is verified
            if (! $user->is_verified) {
                $token = $user->verifyUser()->first()->token;
                return redirect()->route('view.login')->with('token', $token)->withErrors('Please verify your email before logging in.');
            }

            Auth::login($user, true);

        } catch (ModelNotFoundException $e) {
            return redirect()->route('view.login')->withErrors("This account doesn't exist");
        }

        return redirect()->route('view.index');
    }

    /**
     * Verifies a new user account
     */
    public function verify($token)
    {
        $verify_user = VerifyUser::where('token', $token)->first();

        if (isset($verify_user)) {
            $user = $verify_user->user;

            // Set user to verified
            if (! $user->verified) {
                $user->update([
                    'is_verified' => true
                ]);

                return redirect()->route('view.login')->with(['message' => "Your e-mail was successfully verified"]);
            } else {
                return redirect()->route('view.login')->with(['message' => "Your e-mail was already verified"]);
            }
        } else {
            return redirect()->route('view.login')->withErrors("Sorry, your email cannot be identified");
        }
    }

    /**
     * Resend a verification token
     */
    public function resendVerify($token)
    {
        try {
            $verify_user = VerifyUser::where('token', $token)->firstOrFail();

            Mail::to($verify_user->user()->first()->email)->send(new EmailVerification($verify_user->user()->first()));

            return redirect()->route('view.login')->with(['message' => "Please check your email for verification"]);

        } catch (ModelNotFoundException $e) {
            return redirect()->route('view.login')->withErrors("Unknown verification token");
        }
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
