<?php

namespace App\Infrastructure\Database\Trait;

use Cycle\Annotated\Annotation as Cycle;

trait SoftDeletedTrait
{
    #[Cycle\Column(type: 'datetime', nullable: true)]
    protected ?\DateTimeInterface $deletedAt = null;

    public function isDeleted(): bool
    {
        return $this->getDeletedAt() instanceof \DateTimeInterface;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function markAsDeleted(): static
    {
        $this->setDeletedAt(new \DateTime());

        return $this;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt = null): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
