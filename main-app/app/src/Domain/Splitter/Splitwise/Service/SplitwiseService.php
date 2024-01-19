<?php

declare(strict_types=1);

namespace App\Domain\Splitter\Splitwise\Service;

use App\Domain\Splitter\Splitwise\Client\SplitwiseClient;
use App\Infrastructure\DTO\Splitwise\SplitwiseMember;

class SplitwiseService
{
    public function __construct(
        private readonly SplitwiseClient $client
    ) {
    }

    public function getGroupInfo(string $groupId): \Generator
    {
        $response = $this->client->get('https://secure.splitwise.com/api/v3.0/get_group/' . $groupId);
        $groupInfo = json_decode($response->getBody()->getContents(), true, 512, JSON_UNESCAPED_UNICODE| JSON_THROW_ON_ERROR);
        foreach ($groupInfo['group']['members'] as $member) {
            yield new SplitwiseMember($member);
        }
    }
}
