<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model;

use DateTimeImmutable;
use FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject\NumericId;

class Portfolio
{
    private NumericId $id;

    /** @var Allocation[] */
    private array $allocations;

    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $deletedAt;

    public function __construct(NumericId $id, Allocation ...$allocations)
    {
        $this->id = $id;
        $this->allocations = $allocations;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function allocations(): array
    {
        return $this->allocations;
    }

    public function id(): NumericId
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
