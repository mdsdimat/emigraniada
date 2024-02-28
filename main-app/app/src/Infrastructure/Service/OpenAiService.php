<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Application\Config\OpenAIConfig;
use OpenAI\Client;
use OpenAI\Contracts\ClientContract;

class OpenAiService
{
    private Client $client;

    public function __construct(
        readonly private OpenAIConfig $config
    ) {
        $this->client = \OpenAI::client($this->config->getKey());
    }

    public function getClient(): ClientContract
    {
        return $this->client;
    }

    public function getChat(): OpenAiChatWrapper
    {
        return new OpenAiChatWrapper($this->client->chat());
    }
}
