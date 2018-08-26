<?php

namespace EliPett\LoquateClient\Services\Endpoints;

use GuzzleHttp\Client;

class AddressVerification
{
    private $client;
    private $key;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.addressy.com/Capture/Interactive'
        ]);

        $this->key = config('loquateclient.api_key');
    }

    public function find(array $parameters): array
    {
        $parameters['Key'] = $this->key;

        $request = $this->client->post('Find/v1.00/json3.ws', [
            'form_params' => $parameters
        ]);

        $response = json_decode($request->getBody(), true)['Items'];

        if ($this->hasError($response)) {
            $this->throwError($response[0]);
        }

        return $response;
    }

    public function retrieve(string $id): array
    {
        $request = $this->client->post(null, [
            'form_params' => [
                'Key' => $this->key,
                'Id' => $id
            ]
        ]);

        $response = json_decode($request->getBody(), true)['Items'];

        if ($this->hasError($response)) {
            $this->throwError($response[0]);
        }

        return $response[0];
    }

    private function hasError(array $response): bool
    {
        return array_key_exists('Error', $response[0]);
    }

    private function throwError(array $error): void
    {
        $number = array_get($error, 'Error');
        $description = array_get($error, 'Description');
        $cause = array_get($error, 'Cause');

        throw new \InvalidArgumentException("Loquate Error #$number: $description. $cause");
    }
}
