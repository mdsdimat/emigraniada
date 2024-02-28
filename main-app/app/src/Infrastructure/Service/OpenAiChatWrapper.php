<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use OpenAI\Contracts\Resources\ChatContract;
use OpenAI\Resources\Chat;
use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\StreamResponse;

class OpenAiChatWrapper implements ChatContract
{
    public function __construct(
        private readonly Chat $chat
    ) {
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->chat->create($parameters);
    }

    public function createStreamed(array $parameters): StreamResponse
    {
        return $this->chat->createStreamed($parameters);
    }
}
