<?php

namespace EliPett\LoquateClient\Services;

class LoquateClient
{
    private $key;

    public function __construct()
    {
        $this->key = config('loquateclient.api_key');
    }

    public function find(array $parameters)
    {
        $client = LoquateClientFactory::find();

        $parameters['Key'] = $this->key;
        
        $request = $client->post(null, [
            'form_params' => $parameters
        ]);

        $response = json_decode($request->getBody(), true)['Items'];

        if ($this->hasError($response)) {
            throw new \InvalidArgumentException($response[0]['Description']);
        }

        return $response;
    }

    private function hasError(array $response): bool
    {
        return array_key_exists('Error', $response[0]);
    }
}
