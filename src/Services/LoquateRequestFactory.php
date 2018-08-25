<?php

namespace EliPett\LoquateClient\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class LoquateRequestFactory
{
    public static function find(array $parameters): ResponseInterface
    {
        $client =  new Client([
            'base_uri' => 'https://api.addressy.com/Capture/Interactive/Find/v1.00/json3.ws'
        ]);

        $parameters['Key'] = config('loquateclient.api_key');

        return $client->post(null, [
            'form_params' => $parameters
        ]);
    }
}
