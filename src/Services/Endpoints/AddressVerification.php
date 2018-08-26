<?php

namespace EliPett\LoquateClient\Services\Endpoints;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class AddressVerification
{
    public static function find(array $parameters): ResponseInterface
    {
        $client = new Client([
            'base_uri' => 'https://api.addressy.com/Capture/Interactive/Find/v1.00/json3.ws'
        ]);

        $parameters['Key'] = config('loquateclient.api_key');

        return $client->post(null, [
            'form_params' => $parameters
        ]);
    }

    public static function retrieve(string $id): ResponseInterface
    {
        $client = new Client([
            'base_uri' => 'https://api.addressy.com/Capture/Interactive/Retrieve/v1.00/json3.ws'
        ]);

        return $client->post(null, [
            'form_params' => [
                'Key' => config('loquateclient.api_key'),
                'Id' => $id
            ]
        ]);
    }
}
