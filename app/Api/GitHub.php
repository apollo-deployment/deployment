<?php

namespace App\Api;

use GuzzleHttp\Client;

class GitHub
{
    /**
     * GitHub's main API
     */
    private $api;

    /**
     * GitHub has different routes for oauth
     */
    private $oauth;

    /**
     * https://developer.github.com/v3/
     */
    public function __construct()
    {
        $this->api = new Client([
            'base_uri' => 'https://api.github.com/'
        ]);

        $this->oauth = new Client([
            'base_uri' => 'https://github.com/login/oauth/',
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * Returns array with all repo's branches
     *
     * https://developer.github.com/v3/repos/branches/#list-branches
     */
    public function getBranches($username, $repo_name)
    {
        return json_decode(
            $this->api->get("repos/{$username}/{$repo_name}/branches")->getBody()->getContents()
        );
    }

    /**
     * Creates a user access token
     *
     * https://developer.github.com/apps/building-oauth-apps/authorization-options-for-oauth-apps/
     */
    public function getAccessToken($code)
    {
        return json_decode($this->oauth->post('access_token' .
                '?client_id=' . env('GITHUB_ID') .
                '&client_secret=' . env('GITHUB_SECRET') .
                '&code=' . $code
        )->getBody()->getContents())->access_token;
    }
}