<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Application\Enum\HttpStatus;
use App\Domain\Splitter\Splitwise\Service\SplitwiseService;
use App\Endpoint\Web\Request\GetSplitMembersRequest;
use App\Endpoint\Web\Response\SplitService\MembersListResponse;
use Spiral\Http\ResponseWrapper;
use Psr\Http\Message\ResponseInterface;
use Spiral\Router\Annotation\Route;

class SplitServiceController
{
    public function __construct(
        private readonly ResponseWrapper $responseWrapper,
        private readonly SplitwiseService $splitwiseService
    ) {
    }

    #[Route(route: '/split/members', name: 'splitwise', methods: ['GET'])]
    public function getMembers(GetSplitMembersRequest $request): ResponseInterface
    {
        $membersList = new MembersListResponse(
            $this->splitwiseService->getGroupInfo($request->groupId)
        );
        return $this->responseWrapper->json($membersList->jsonSerialize(), HttpStatus::Ok->value);
    }
}
