<?php

namespace App\Infrastructure\Database\Trait;

use Cycle\Annotated\Annotation\Column;

trait TsTrait
{
    #[Column(type: 'datetime', name: 'created_at', nullable: true)]
    protected ?\DateTimeImmutable $createdAt = null;

    #[Column(type: 'datetime', name: 'updated_at', nullable: true)]
    protected ?\DateTimeImmutable $updatedAt = null;

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): self
    {
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }
}
