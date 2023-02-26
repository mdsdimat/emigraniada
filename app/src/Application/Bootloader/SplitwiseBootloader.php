<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use App\Domain\Splitwise\Service\Client\SplitwiseClient;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\EnvironmentInterface;

class SplitwiseBootloader extends Bootloader
{
    protected const SINGLETONS = [
        SplitwiseClient::class => [self::class, 'provider']
    ];

    private function provider(EnvironmentInterface $env): SplitwiseClient
    {
        return new SplitwiseClient([
            'headers' => [
                'Authorization' => 'Bearer ' . $env->get('SPLITWISE_API_KEY'),
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
        ]);
    }
}
