<?php

namespace App\Api;

use GuzzleHttp\Client;

class GitHub
{
    private $api;

    /**
     * Docs : https://developer.github.com/v3/
     */
    public function __construct()
    {
        $this->api = new Client([
            'base_uri' => 'https://api.github.com/'
        ]);
    }

    /**
     * Returns array with all repo's branches
     */
    public function getBranches($username, $repo_name)
    {
        return json_decode($this->api->get('repos/' . $username . '/' . $repo_name . '/branches')->getBody()->getContents());
    }

}