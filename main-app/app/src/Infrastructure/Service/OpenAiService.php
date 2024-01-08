<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Application\Config\OpenAIConfig;
use OpenAI\Client;

class OpenAiService
{
    private Client $client;

    public function __construct(
        readonly private OpenAIConfig $config
    ) {
        $this->client = \OpenAI::client($this->config->getKey());
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
