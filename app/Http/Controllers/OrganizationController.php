<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterOrganizationRequest;
use App\Http\Requests\UserRequest;
use App\Mail\EmailVerification;
use App\Models\Organization;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Auth;
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
     * View for editing an organization (Admin only)
     */
    public function edit()
    {
        return view('pages.organizations.edit');
    }

    /**
     * Store new organization
     */
    public function store(RegisterOrganizationRequest $request)
    {
        if (Organization::where('title', $request->get('title'))->first()) {
            return redirect()->route('register.org')->withErrors(['title' => "Organization with that name already exists"]);
        }

        $organization = Organization::create([
            'title' => $request->get('title')
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'organization_id' => $organization->id,
            'is_admin' => true,
        ]);

        VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new EmailVerification($user));

        return redirect()->route('register.org')->with(['message' => "Please check your email to verify your new account"]);
    }

    /**
     * Create a new user for an organization
     */
    public function createUser(UserRequest $request)
    {
        $user = User::create([
           'name' => $request->get('user-name'),
           'email' => $request->get('user-email'),
           'organization_id' => Auth::user()->organization_id,
           'password' => Hash::make($request->get('temp-password')),
           'is_admin' => (boolean)$request->get('is_admin')
        ]);

        VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new EmailVerification($user));

        return redirect()->route('view.profile')->with(['message' => "Successfully created user for this organization"]);
    }

    /**
     * Updates existing user in an organization
     */
    public function updateUser(User $user, UserRequest $request)
    {
        $user->update([
            'name' => $request->get('user-name'),
            'email' => $request->get('user-email'),
            'is_admin' => (boolean)$request->get('is_admin')
        ]);

        return redirect()->route('view.profile')->with(['message' => "Successfully updated {$user->name}"]);
    }

    /**
     * Delete a user from an organization
     */
    public function deleteUser(User $user)
    {
        $user->verifyUser()->delete();
        $user->delete();

        return redirect()->route('view.profile')->with(['message' => "Successfully deleted user from this organization"]);
    }
}
