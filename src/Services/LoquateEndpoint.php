<?php

namespace EliPett\LoquateClient\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class LoquateEndpoint
{
    protected $client;
    protected $key;

    public function __construct()
    {
        $this->client = new Client();
        $this->key = config('loquateclient.api_key', env('LOQUATE_API_KEY'));
    }

    protected function all(ResponseInterface $request): array
    {
        $response = json_decode($request->getBody(), true)['Items'];

        if ($this->hasError($response)) {
            $this->throwError($response[0]);
        }

        return $response;
    }

    protected function first(ResponseInterface $request): array
    {
        return $this->all($request)[0];
    }

    private function hasError(array $response): bool
    {
        return array_key_exists('Error', $response[0]);
    }

    private function throwError(array $error): void
    {
        throw new \InvalidArgumentException(trans('loquateclient::messages.error.api', [
            'number' => array_get($error, 'Error'),
            'description' => array_get($error, 'Description'),
            'cause' => array_get($error, 'Cause')
        ]));
    }
}
