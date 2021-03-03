<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model;

use DateTimeImmutable;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event\AllocationCreated;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event\AllocationUpdated;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\WithEvents;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class Allocation
{
    use WithEvents;

    private NumericId $id;
    private Portfolio $portfolio;

    private Shares $shares;

    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $deletedAt;

    public function __construct(NumericId $id, Portfolio $portfolio, Shares $shares)
    {
        $this->id = $id;
        $this->portfolio = $portfolio;
        $this->createdAt = new DateTimeImmutable();
        $this->doUpdate($shares);

        $this->publishEvent(new AllocationCreated($this));
    }

    public function update(Shares $shares): static
    {
        $this->doUpdate($shares);
        $this->publishEvent(new AllocationUpdated($this));
        return $this;
    }

    public function id(): NumericId
    {
        return $this->id;
    }

    public function portfolio(): Portfolio
    {
        return $this->portfolio;
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

    private function doUpdate(Shares $shares): void
    {
        $this->shares = $shares;
        $this->updatedAt = new DateTimeImmutable();
    }
}
