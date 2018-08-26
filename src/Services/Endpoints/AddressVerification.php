<?php

namespace EliPett\LoquateClient\Services\Endpoints;

use EliPett\LoquateClient\Services\LoquateEndpoint;

class AddressVerification extends LoquateEndpoint
{
    private $uri = 'https://api.addressy.com/Capture/Interactive';

    public function find(array $parameters): array
    {
        $parameters['Key'] = $this->key;

        $request = $this->client->post("{$this->uri}/Find/v1.00/json3.ws", [
            'form_params' => $parameters
        ]);

        return $this->all($request);
    }

    public function retrieve(string $id): array
    {
        $request = $this->client->post("{$this->uri}Retrieve/v1.00/json3.ws", [
            'form_params' => [
                'Key' => $this->key,
                'Id' => $id
            ]
        ]);

        return $this->first($request);
    }
}
