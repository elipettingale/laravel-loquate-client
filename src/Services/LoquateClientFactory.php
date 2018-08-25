<?php

namespace EliPett\LoquateClient\Services;

use GuzzleHttp\Client;

class LoquateClientFactory
{
    public static function find(): Client
    {
        return new Client([
            'base_uri' => 'https://api.addressy.com/Capture/Interactive/Find/v1.00/json3.ws'
        ]);
    }
}
