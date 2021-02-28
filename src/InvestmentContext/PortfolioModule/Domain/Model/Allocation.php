<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model;

use DateTimeImmutable;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject\NumericId;

class Allocation
{
    private NumericId $id;
    private Shares $shares;

    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $deletedAt;

    public function __construct(NumericId $id, Shares $shares)
    {
        $this->id = $id;
        $this->shares = $shares;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function id(): NumericId
    {
        return $this->id;
    }

    public function shares(): Shares
    {
        return $this->shares;
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
