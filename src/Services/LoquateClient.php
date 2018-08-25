<?php

namespace EliPett\LoquateClient\Services;

class LoquateClient
{
    public function find(array $parameters)
    {
        $request = LoquateRequestFactory::find($parameters);
        $response = json_decode($request->getBody(), true)['Items'];

        if ($this->hasError($response)) {
            $this->throwError($response[0]);
        }

        return $response;
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
