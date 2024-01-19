<?php

declare(strict_types=1);

namespace App\Domain\Splitter\Splitwise\Entity;

use App\Domain\Splitter\Splitwise\Repository\SplitwiseRepository;
use App\Infrastructure\Database\AbstractEntity;
use App\Infrastructure\Database\Interface\SoftDeletable;
use App\Infrastructure\Database\Trait\SoftDeletedTrait;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;

#[Entity(
    repository: SplitwiseRepository::class,
)]
class Splitwise extends AbstractEntity implements SoftDeletable
{
    use SoftDeletedTrait;

    #[Column(type: 'string', default: '')]
    public string $apiKey = '';

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): static
    {
        $this->apiKey = $apiKey;
        return $this;
    }
}
