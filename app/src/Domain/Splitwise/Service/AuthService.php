<?php

declare(strict_types=1);

namespace App\Domain\Splitwise\Service;

use App\Domain\Splitwise\Service\Client\SplitwiseClient;

class AuthService
{
    public function __construct(
        private readonly SplitwiseClient $client
    ) {
    }

    public function getAllExpenses(?string $groupId = null): void
    {
        $params = [
            'query' => [
                'group_id' => $groupId,
            ]
        ];

        $response = $this->client->request(
            'GET',
            'https://secure.splitwise.com/api/v3.0/get_expenses',
            $params
        );

        echo $response->getBody();
    }
}
