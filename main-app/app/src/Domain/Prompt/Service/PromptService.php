<?php

declare(strict_types=1);

namespace App\Domain\Prompt\Service;

use App\Infrastructure\Service\OpenAiService;

class PromptService
{
    public function __construct(
        private readonly OpenAiService $openAiService
    ) {
    }

    public function executeChatPrompt(string $prompt): array
    {
        $result = $this->openAiService->getChat()
            ->create(
                [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ]
            );

        $scanResult = [];
        foreach ($result->choices as $choice) {
            $scanResult[] = (string)$choice->message->content;
        }
        return $scanResult;
    }
}
