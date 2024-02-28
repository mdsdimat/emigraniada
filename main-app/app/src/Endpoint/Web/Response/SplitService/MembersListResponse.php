<?php

declare(strict_types=1);

namespace App\Endpoint\Web\Response\SplitService;

use App\Endpoint\Web\Response\ItemsListResponse;
use App\Infrastructure\DTO\Splitwise\SplitwiseMember;

class MembersListResponse extends ItemsListResponse
{
    /**
     * @param SplitwiseMember[] $members
     */
    public function __construct(iterable $members)
    {
        foreach ($members as $member) {
            $this->addItem($member);
        }
    }
}
