<?php

namespace FinizensChallenge\SharedContext\SharedModule\Entity\Domain\Model;

use DateTimeImmutable;
use FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject\Id;

abstract class Entity
{
    private Id $id;

    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $deletedAt;

    public function __construct(Id $id)
    {
        $this->id = $id;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function deletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }
}
