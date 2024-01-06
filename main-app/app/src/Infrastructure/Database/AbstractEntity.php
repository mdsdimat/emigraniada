<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use Cycle\Annotated\Annotation as Cycle;

abstract class AbstractEntity
{
    #[Cycle\Column(type: 'bigPrimary', primary: true)]
    protected ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
