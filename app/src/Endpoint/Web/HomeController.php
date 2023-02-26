<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Domain\Splitwise\Service\AuthService;
use Exception;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Http\ResponseWrapper;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

/**
 * Simple home page controller. It renders home page template and also provides
 * an example of exception page.
 */
final class HomeController
{
    /**
     * Read more about Prototyping:
     * @link https://spiral.dev/docs/basics-prototype/#installation
     */
    use PrototypeTrait;


    public function __construct(
        private readonly ResponseWrapper $response,
        private readonly AuthService $authService
    ) {
    }

    #[Route(route: '/', name: 'index')]
    public function index(): string
    {
        return $this->views->render('home');
    }

    /**
     * Example of exception page.
     */
    #[Route(route: '/exception', name: 'exception')]
    public function exception(): never
    {
        throw new Exception('This is a test exception.');
    }

    #[Route(route: '/splitwise', name: 'splitwise')]
    public function splitwiseInfo(ServerRequestInterface $request): void
    {
        $this->authService->getAllExpenses(
            $request->getQueryParams()['group_id']
        );
    }
}
