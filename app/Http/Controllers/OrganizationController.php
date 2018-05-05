<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Http\Requests\RegisterOrganizationRequest;
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
            return redirect()->route('register.org')->withErrors("Organization with that name already exists");
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
     * Update an existing organization
     */
    public function update(Organization $organization, OrganizationRequest $request)
    {
        $organization->update([
            // Nothing to update yet
        ]);
    }
}
