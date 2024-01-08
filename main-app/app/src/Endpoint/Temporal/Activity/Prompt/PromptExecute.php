<?php

declare(strict_types=1);

namespace App\Endpoint\Temporal\Activity\Prompt;

use Spiral\TemporalBridge\Attribute\AssignWorker;
use Temporal\Activity\ActivityMethod;
use App\Domain\Prompt\Service\PromptService;

#[AssignWorker(name: 'scanner')]
class PromptExecute implements PromptExecuteActivityInterface
{

    public function __construct(
        private PromptService $promptService
    ) {
    }

    #[ActivityMethod]
    public function execute(string $promptText): array
    {
        return $this->promptService->executeChatPrompt($promptText);
    }
}
