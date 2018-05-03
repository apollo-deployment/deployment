<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\Organization;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OrganizationController extends Controller
{
    /**
     * View for creating an organization
     */
    public function create()
    {
        return view('pages.organizations.create');
    }

    /**
     * Store new organization
     */
    public function store()
    {
        $organization = Organization::create([
            'title' => request('title')
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'organization_id' => $organization->id,
            'is_admin' => true,
        ]);

        VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new EmailVerification($user));

        return redirect()->route('register.org')->with(['message' => 'Please check your email to verify your account']);
    }

    /**
     * Verifies a new user account
     */
    public function verify($token)
    {
        $verify_user = VerifyUser::where('token', $token)->first();

        if (isset($verify_user)) {
            $user = $verify_user->user;

            if (! $user->verified) {
                $user->update([
                    'verified' => true
                ]);

                return redirect()->route('view.login')->with(['message' => 'Your e-mail was successfully verified']);
            } else {
                return redirect()->route('view.login')->with(['message' => 'Your e-mail was already verified']);
            }
        } else {
            return redirect()->route('view.login')->withErrors("Sorry, your email cannot be identified");
        }
    }
}
