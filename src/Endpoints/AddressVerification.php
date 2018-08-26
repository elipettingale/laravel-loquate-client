<?php

namespace EliPett\LoquateClient\Endpoints;

use EliPett\LoquateClient\Processors\ResponseProcessor;
use GuzzleHttp\Client;

class AddressVerification
{
    private $client;
    private $key;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.addressy.com/Capture/Interactive/'
        ]);

        $this->key = config('loquateclient.api-key',
            env('LOQUATE_API_KEY')
        );
    }

    public function find(array $parameters): array
    {
        $parameters['Key'] = $this->key;

        $response = $this->client->post('Find/v1.00/json3.ws', [
            'form_params' => $parameters
        ]);

        return ResponseProcessor::all($response);
    }

    public function retrieve(string $id): array
    {
        $response = $this->client->post('/Retrieve/v1.00/json3.ws', [
            'form_params' => [
                'Key' => $this->key,
                'Id' => $id
            ]
        ]);

        return ResponseProcessor::first($response);
    }
}
