<?php

namespace EliPett\LoquateClient\Services;

class LoquateClient
{
    public function __get($name)
    {
        $endpoint = 'EliPett\\LoquateClient\\Services\\Endpoints\\' . ucfirst($name);

        if (class_exists($endpoint)) {
            return new $endpoint;
        }

        throw new \InvalidArgumentException(trans('loquateclient.error.endpoint'));
    }
}
