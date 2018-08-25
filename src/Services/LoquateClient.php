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

        return json_decode($request->getBody(), true);
    }
}
