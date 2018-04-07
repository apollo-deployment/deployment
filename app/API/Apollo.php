<?php

namespace App\API;

use GuzzleHttp\Client;

class Apollo
{
    private $api;

    /**
     * Create API client
     */
    public function __construct()
    {
        $this->api = new Client([
            'base_uri' => env('APOLLO_API'),
        ]);
    }

    /**
     * Checks if user exists on API
     */
    public function login($request)
    {
        return json_decode($this->api->post('login', [
            'form_params' => [
                'username' => $request->username,
                'password' => $request->password,
            ]
        ])->getBody()->getContents());
    }

}