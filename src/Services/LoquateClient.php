<?php

namespace EliPett\LoquateClient\Services;

use EliPett\LoquateClient\Enums\ResponseFormats;
use GuzzleHttp\Client;

class LoquateClient
{
    private $key;
    private $format;

    public function __construct()
    {
        $this->key = config('loquateclient.api_key');
        $this->format = config('loquateclient.response_format');
    }

    public function find(array $parameters)
    {
        $client = new Client([
            'base_uri' => "https://api.addressy.com/Capture/Interactive/Find/v1.00/{$this->format}"
        ]);

        $parameters['Key'] = $this->key;
        
        $request = $client->post(null, [
            'form_params' => $parameters
        ]);

        if ($this->format === ResponseFormats::JSON) {
            return json_decode($request->getBody(), true);
        }

        throw new \InvalidArgumentException(trans('loquateclient.invalid-argument', ['argument' => 'Response Format']));
    }
}
