<?php

namespace App\Infrastructure\Database\Interface;

interface SoftDeletable
{
    public function isDeleted(): bool;

    public function getDeletedAt(): ?\DateTimeInterface;

    public function markAsDeleted(): static;

    public function setDeletedAt(?\DateTimeInterface $deletedAt = null): static;
}
