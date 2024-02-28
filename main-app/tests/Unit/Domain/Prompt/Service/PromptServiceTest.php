<?php

declare(strict_types=1);

namespace tests\Unit\Domain\Prompt\Service;

use App\Domain\Prompt\Service\PromptService;
use App\Infrastructure\Service\OpenAiChatWrapper;
use App\Infrastructure\Service\OpenAiService;
use PHPUnit\Framework\TestCase;
use OpenAI\Responses\Chat\CreateResponse;

class PromptServiceTest extends TestCase
{
    public function testExecuteChatPrompt(): void
    {
        $chatWrapperMock = $this->createMock(OpenAiChatWrapper::class);
        $openAiServiceMock = $this->createMock(OpenAiService::class);
        $openAiServiceMock->method('getChat')->willReturn($chatWrapperMock);

        $response = CreateResponse::fake(
            [
                'choices' => [
                    [
                        'index' => 0,
                        'message' => [
                            'role' => 'assistant',
                            'content' => "Response 1",
                            'function_call' => null,
                            'tool_calls' => [],
                        ],
                        'finish_reason' => 'stop',
                    ],
                    [
                        'index' => 1,
                        'message' => [
                            'role' => 'assistant',
                            'content' => "Response 2",
                            'function_call' => null,
                            'tool_calls' => [],
                        ],
                        'finish_reason' => 'stop',
                    ],
                ],
            ],
        );
        $chatWrapperMock->expects($this->once())
            ->method('create')
            ->with([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => 'Test prompt'],
                ],
            ])
            ->willReturn($response);

        $promptService = new PromptService($openAiServiceMock);

        $result = $promptService->executeChatPrompt('Test prompt');

        $this->assertEquals(["Response 1", "Response 2"], $result);
    }

}
