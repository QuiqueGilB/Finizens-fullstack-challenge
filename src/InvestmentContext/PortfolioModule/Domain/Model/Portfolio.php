<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event\PortfolioCreated;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event\PortfolioUpdated;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\WithEvents;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class Portfolio
{
    use WithEvents;

    private NumericId $id;
    /** @var Collection<Allocation> */
    private Collection $allocations;

    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $deletedAt;

    public function __construct(NumericId $id)
    {
        $this->id = $id;
        $this->createdAt = new DateTimeImmutable();
        $this->doUpdate(null);

        $this->publishEvent(new PortfolioCreated($this));
    }

    public function update(?Allocation ...$allocations): self
    {
        $this->doUpdate(...$allocations);
        $this->publishEvent(new PortfolioUpdated($this));

        return $this;
    }

    private function doUpdate(?Allocation ...$allocations): void
    {
        $this->allocations = new ArrayCollection($allocations);
        $this->updatedAt = new DateTimeImmutable();
    }

    /** @return Allocation[] */
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

    public function allocation(NumericId $allocationId): ?Allocation
    {
        /** @var Allocation $allocation */
        foreach ($this->allocations as $allocation) {
            if ($allocation->id()->equal($allocationId)) {
                return $allocation;
            }
        }

        return null;
    }

    public function createOrUpdateAllocation(
        NumericId $allocationId,
        Shares $shares
    ): Allocation {
        $allocation = $this->allocation($allocationId);

        null === $allocation
            ? $this->allocations->add($allocation = new Allocation($allocationId, $this, $shares))
            : $allocation->update($shares);

        $this->publishEvent(new PortfolioUpdated($this));
        return $allocation;
    }

    public function deleteAllocation(Allocation $allocation): self
    {
        foreach ($this->allocations as $key => $portfolioAllocation) {
            if ($allocation->id()->equal($allocation->id())) {
                $portfolioAllocation->delete();
                $this->allocations->remove($key);
                break;
            }
        }

        $this->publishEvent(new PortfolioUpdated($this));
        return $this;
    }

}
