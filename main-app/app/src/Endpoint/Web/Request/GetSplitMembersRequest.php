<?php

declare(strict_types=1);

namespace App\Endpoint\Web\Request;

use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\FilterInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validator\FilterDefinition;
use Spiral\Filters\Attribute\Input\Query;

class GetSplitMembersRequest implements FilterInterface, HasFilterDefinition
{
    #[Query(key: 'groupId')]
    public string $groupId;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition(
            validationRules: [
                'groupId' => [
                    ['notEmpty'],
                    ['string::shorter', 50]
                ],
            ]
        );
    }
}
