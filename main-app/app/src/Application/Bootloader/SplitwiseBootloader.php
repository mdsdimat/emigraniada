<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use App\Infrastructure\Config\EnvConfig;
use Spiral\Boot\Bootloader\Bootloader;
use App\Domain\Splitter\Splitwise\Client\SplitwiseClient;

class SplitwiseBootloader extends Bootloader
{
    protected const SINGLETONS = [
        SplitwiseClient::class => [self::class, 'provider']
    ];

    private function provider(EnvConfig $config): SplitwiseClient
    {
        return new SplitwiseClient([
            'headers' => [
                'Authorization' => 'Bearer ' . $config->getSplitwiseApiKey(),
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
        ]);
    }
}
