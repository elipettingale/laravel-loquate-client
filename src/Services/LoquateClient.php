<?php

namespace EliPett\LoquateClient\Services;

use EliPett\LoquateClient\Endpoints\AddressVerification;

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
        $class = 'EliPett\\LoquateClient\\Endpoints\\' . ucfirst($name);

        if (class_exists($class)) {
            return new $class;
        }

        throw new \InvalidArgumentException(trans('loquateclient::messages.error.endpoint'));
    }
}
