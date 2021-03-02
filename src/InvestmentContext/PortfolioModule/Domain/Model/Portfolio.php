<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class Portfolio
{
    private NumericId $id;
    private Collection $allocations;

    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $deletedAt;

    public function __construct(NumericId $id)
    {
        $this->id = $id;
        $this->doUpdate(null);
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function update(?Allocation ...$allocations): self
    {
        $this->doUpdate(...$allocations);
        return $this;
    }

    private function doUpdate(?Allocation ...$allocations): void
    {
        $this->allocations = new ArrayCollection($allocations);
        $this->updatedAt = new DateTimeImmutable();
    }

    public function allocations(): array
    {
        return $this->allocations->toArray();
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
