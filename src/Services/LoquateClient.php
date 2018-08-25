<?php

namespace EliPett\LoquateClient\Services;

class LoquateClient
{
    public function find(array $parameters)
    {
        $request = LoquateRequestFactory::find($parameters);
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
