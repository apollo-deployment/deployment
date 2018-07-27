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
//            ,
//            'headers' => [
//                'Accept' => 'application/json',
//                'Authorization' => 'token 933e7e16c558537f62961ef6c67612b8244a0d41'
//            ]
        ]);

        $this->oauth = new Client([
            'base_uri' => 'https://github.com/login/oauth/',
//            'headers' => [
//                'Accept' => 'application/json',
//                'token' => '933e7e16c558537f62961ef6c67612b8244a0d41'
//            ]
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
     * Returns array with all repo's webhooks
     *
     * https://developer.github.com/v3/repos/hooks/#list-hooks
     */
    public function getHooks($username, $repo_name) {
        // GET /repos/:owner/:repo/hooks
        //TODO: set the header correctly

        return json_decode(
            $this->api->request("get", "repos/{$username}/{$repo_name}/hooks", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'token 933e7e16c558537f62961ef6c67612b8244a0d41'
                    ]
        ])->getBody()->getContents()
        );
    }

    /**
     * Returns array with all repo's branches
     *
     * https://developer.github.com/v3/repos/hooks/#list-hooks
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createHooks($username, $repo_name) {
        // POST /repos/:owner/:repo/hooks
        //TODO: set the header correctly
        //TODO: fix the payload
        //TODO: set the get back to post on the web.php routes
        //TODO: send the payload as a form_params
        $data = [
            'json' => [
                'name' => 'web',
//              'active' => true,
                'events' => ['push'],
                'config' => [
                    'url' => 'http://ab47d7ec.ngrok.io/access/callback'//,
//                  'content_type' => 'json'
                ]
            ]
        ];

        try {
            $this->api->request("post", "repos/{$username}/{$repo_name}/hooks", [
                'headers' => [
                    'Authorization' => 'token 933e7e16c558537f62961ef6c67612b8244a0d41'
                ],
                'json' => [
                    'name' => 'web',
                    'events' => ['push'],
                    'config' => [
                        'url' => 'https://ab47d7ec.ngrok.io/github/getPayload'
                    ]
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($e->getResponse()->getBody()->getContents());
        }

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
