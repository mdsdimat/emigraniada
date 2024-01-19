<?php

declare(strict_types=1);

namespace App\Infrastructure\Config;

use Spiral\Boot\EnvironmentInterface;

class EnvConfig
{

    public function __construct(
        private readonly EnvironmentInterface $env
    ) {
    }

    public function getEnvVar(string $label, mixed $default = null): mixed
    {
        return $this->env->get($label, $default);
    }

    public function getSplitwiseApiKey(): string
    {
        return $this->getEnvVar('SPLITWISE_API_KEY');
    }
}
