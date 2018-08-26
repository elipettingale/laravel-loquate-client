<?php

namespace EliPett\LoquateClient\Services;

use EliPett\LoquateClient\Services\Endpoints\AddressVerification;
use Psr\Http\Message\ResponseInterface;

class LoquateClient
{
    public function find(array $parameters): array
    {
        $request = AddressVerification::find($parameters);

        return $this->all($request);
    }

    public function retrieve(string $id): array
    {
        $request = AddressVerification::retrieve($id);

        return $this->first($request);
    }

    private function all(ResponseInterface $request): array
    {
        $response = json_decode($request->getBody(), true)['Items'];

        if ($this->hasError($response)) {
            $this->throwError($response[0]);
        }

        return $response;
    }

    private function first(ResponseInterface $request): array
    {
        return $this->all($request)[0];
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
