<?php

namespace App\Apollo;

use GuzzleHttp\Client;

class ApolloAPI
{
    private $api;

    public function __construct()
    {
        $this->api = new Client([
            'base_uri' => env('APOLLO_API')
        ]);
    }

    /**
     * Gets APIs Google OAuth keys
     */
    public function getGoogleKeys()
    {
        return json_decode($this->api->get('google-keys')->getBody()->getContents());
    }

}