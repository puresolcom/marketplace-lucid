<?php

namespace App\Domains\User\Jobs;

use Awok\Foundation\Job;
use GuzzleHttp\Client;
use Laravel\Lumen\Application;

class KongAuthenticateJob extends Job
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle(Application $app)
    {
        $clientID          = $app->make('option')->get('auth', 'oauth_client_id');
        $clientSecret      = $app->make('option')->get('auth', 'oauth_client_secret');
        $oauthProvisionKey = $app->make('option')->get('auth', 'oauth_provision_key');

        $httpClient = new Client();

        $response = $httpClient->request('POST', config('app.gateway_url').'/oauth2/token', [
            'verify'      => false,
            'curl'        => [
                CURLOPT_SSLVERSION     => 1,
                CURLOPT_SSL_VERIFYPEER => false,
            ],
            'form_params' => [
                'client_id'            => $clientID,
                'client_secret'        => $clientSecret,
                'provision_key'        => $oauthProvisionKey,
                'grant_type'           => 'password',
                'authenticated_userid' => $this->user->id,
            ],
        ]);

        return array_merge(json_decode($response->getBody()->getContents(), true), ['user' => $this->user->toArray()]);
    }
}