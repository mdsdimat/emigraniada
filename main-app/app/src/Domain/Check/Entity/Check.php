<?php

declare(strict_types=1);

namespace App\Domain\Check\Entity;

use App\Domain\File\Entity\File;
use App\Infrastructure\Database\AbstractEntity;
use App\Infrastructure\Database\Interface\SoftDeletable;
use App\Infrastructure\Database\Trait\SoftDeletedTrait;
use Cycle\Annotated\Annotation\Relation\HasOne;
use App\Domain\Check\Repository\CheckRepository;
use Cycle\Annotated\Annotation\Entity;

#[Entity(
    repository: CheckRepository::class,
)]
class Check extends AbstractEntity implements SoftDeletable
{
    use SoftDeletedTrait;

    #[HasOne(File::class)]
    public ?File $file = null;
}
