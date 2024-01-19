<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Application\Enum\HttpStatus;
use App\Domain\Splitter\Splitwise\Service\SplitwiseAuthService;
use App\Endpoint\Web\Request\LoadCheckRequest;
use Psr\Http\Message\ResponseInterface;
use Spiral\Http\ResponseWrapper;
use Spiral\Router\Annotation\Route;
use App\Domain\Check\Service\CheckService;

class CheckController
{
    public function __construct(
        private readonly CheckService $checkService,
        private readonly ResponseWrapper $responseWrapper,
        private readonly SplitwiseAuthService $splitwiseAuthService
    ) {
    }

    #[Route(route: '/load-check', name: 'splitwise')]
    public function loadCheck(LoadCheckRequest $checkRequest): ResponseInterface
    {
        $this->checkService->createByRequest($checkRequest);
        return $this->responseWrapper->create(HttpStatus::Ok->value);
    }

    #[Route(route: '/group-info', name: 'splitwise')]
    public function getGroupInfo(): ResponseInterface
    {
        $this->splitwiseAuthService->getGroupInfo('29161548');
        return $this->responseWrapper->create(HttpStatus::Ok->value);
    }
}
