<?php

declare(strict_types=1);

namespace tests\Integration\Endpoint\Web;

use App\Application\Enum\HttpStatus;
use App\Domain\Splitter\Splitwise\Client\SplitwiseClient;
use App\Domain\Splitter\Splitwise\Service\SplitwiseService;
use App\Endpoint\Web\Request\GetSplitMembersRequest;
use App\Endpoint\Web\SplitServiceController;
use Codeception\Attribute\DataProvider;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Spiral\Http\ResponseWrapper;
use Tests\TestCase;

class SplitServiceControllerTest extends TestCase
{
    protected function setUp(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode(
                [
                    'group' => [
                        'members' => [
                            ['id' => 1, 'first_name' => 'member1', 'email' => 'member1@test.com'],
                            ['id' => 2, 'first_name' => 'member2', 'email' => 'member2@test.com']
                        ]
                    ]
                ],
                JSON_THROW_ON_ERROR)),
        ]);

        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new SplitwiseClient(['handler' => $handlerStack]);

        $splitwiseService = new SplitwiseService($httpClient);

        $this->splitServiceController = new SplitServiceController(
            $this->getContainer()->get(ResponseWrapper::class),
            $splitwiseService
        );
    }

    #[DataProvider('getMembersDataProvider')]
    public function testGetMembersReturnsCorrectResponse($groupId, $expectedResponse)
    {
        $request = new GetSplitMembersRequest();
        $request->groupId = $groupId;

        $response = $this->splitServiceController->getMembers($request);

        $this->assertEquals(HttpStatus::Ok->value, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($response->getBody()->__toString(), true, 512, JSON_THROW_ON_ERROR));
    }

    public function getMembersDataProvider()
    {
        return [
            [
                'test',
                [
                    ['id' => 1, 'name' => 'member1 ', 'email' => 'member1@test.com'],
                    ['id' => 2, 'name' => 'member2 ', 'email' => 'member2@test.com']
                ]
            ],
        ];
    }
}
