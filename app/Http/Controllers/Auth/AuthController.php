<?php

namespace App\Http\Controllers\Auth;

use App\Apollo\ApolloAPI;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Google OAuth callback. Creates new user if they don't exist
     */
    public function googleCallback()
    {
        $google_user = $this->socialite()->user();

        dd($google_user);


        return redirect()->route('view.bots');
    }

    /**
     * Logout authenticated user
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('view.login');
    }

    /**
     * Redirect to Google OAuth login
     */
    public function redirectToGoogle()
    {
        return $this->socialite()->redirect();
    }

    /**
     * Load 3rd party authentication package
     */
    private function socialite()
    {
        $api = new ApolloAPI;
        $keys = $api->getGoogleKeys();

        $config['client_id'] = $keys->public;
        $config['client_secret'] = $keys->secret;
        $config['redirect'] = env('APP_URL') . 'login/google/callback';

        return \Socialite::buildProvider(\Laravel\Socialite\Two\GoogleProvider::class, $config);
    }
}
