<?php

namespace EliPett\LoquateClient\Processors;

use Psr\Http\Message\ResponseInterface;

class ResponseProcessor
{
    public static function all(ResponseInterface $request): array
    {
        $response = json_decode($request->getBody(), true)['Items'];

        if (self::hasError($response)) {
            self::throwError($response[0]);
        }

        return $response;
    }

    public static function first(ResponseInterface $request): array
    {
        return self::all($request)[0];
    }

    private static function hasError(array $response): bool
    {
        return array_key_exists('Error', $response[0]);
    }

    private static function throwError(array $error): void
    {
        throw new \InvalidArgumentException(trans('loquateclient::messages.error.api', [
            'number' => array_get($error, 'Error'),
            'description' => array_get($error, 'Description'),
            'cause' => array_get($error, 'Cause')
        ]));
    }
}