<?php

namespace EliPett\LoquateClient\Services;

use EliPett\LoquateClient\Services\Endpoints\AddressVerification;

/**
 * Class LoquateClient
 * @package EliPett\LoquateClient\Services
 *
 * @property AddressVerification addressVerification
 */
class LoquateClient
{
    public function __get($name)
    {
        $class = 'EliPett\\LoquateClient\\Services\\Endpoints\\' . ucfirst($name);

        if (class_exists($class)) {
            return new $class;
        }

        throw new \InvalidArgumentException(trans('loquateclient.error.endpoint'));
    }
}
