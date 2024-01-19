<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Application\Enum\HttpStatus;
use App\Endpoint\Web\Request\LoadCheckRequest;
use Psr\Http\Message\ResponseInterface;
use Spiral\Http\ResponseWrapper;
use Spiral\Router\Annotation\Route;
use App\Domain\Check\Service\CheckService;

class CheckController
{
    public function __construct(
        private readonly CheckService $checkService,
        private readonly ResponseWrapper $responseWrapper
    ) {
    }

    #[Route(route: '/load-check', name: 'splitwise')]
    public function loadCheck(LoadCheckRequest $checkRequest): ResponseInterface
    {
        $this->checkService->createByRequest($checkRequest);
        return $this->responseWrapper->create(HttpStatus::Ok->value);
    }
}
