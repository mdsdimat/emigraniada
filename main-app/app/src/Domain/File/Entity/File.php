<?php

declare(strict_types=1);

namespace App\Domain\File\Entity;

use App\Domain\File\Repository\FileRepository;
use App\Infrastructure\Database\AbstractEntity;
use App\Infrastructure\Database\Interface\SoftDeletable;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use App\Infrastructure\Database\Trait\SoftDeletedTrait;

#[Entity(
    repository: FileRepository::class,
)]
class File extends AbstractEntity implements SoftDeletable
{
    use SoftDeletedTrait;

    public function __construct(
        #[Column(type: 'string')]
        public string $filePath,
        #[Column(type: 'string')]
        public string $fileName
    ) {
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): static
    {
        $this->filePath = $filePath;
        return $this;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): static
    {
        $this->fileName = $fileName;
        return $this;
    }
}
