<?php

namespace App\Endpoint\Temporal\Activity\Prompt;

use Spiral\TemporalBridge\Attribute\AssignWorker;
use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface(prefix:"scanner.prompt.")]
#[AssignWorker(name: 'scanner')]
interface PromptExecuteActivityInterface
{
    #[ActivityMethod]
    public function execute(string $promptText): array; // phpcs:ignore
}
