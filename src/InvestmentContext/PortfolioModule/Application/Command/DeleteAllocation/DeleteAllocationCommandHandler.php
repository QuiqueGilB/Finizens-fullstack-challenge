<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\DeleteAllocation;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\AllocationNotFoundException;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\EventBus;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class DeleteAllocationCommandHandler
{

    public function __construct(
        private PortfolioRepository $portfolioRepository,
        private EventBus $eventBus
    ) {
    }

    public function handle(DeleteAllocationCommand $command): void
    {
        $allocationId = new NumericId($command->allocationId());
        $allocation = $this->portfolioRepository->allocationById($allocationId);

        if (null === $allocation) {
            throw new AllocationNotFoundException($allocationId->value());
        }

        $portfolio = $allocation->portfolio();

        $portfolio->deleteAllocation($allocation);

        $this->portfolioRepository->save($portfolio);

        $this->eventBus->dispatch(...$portfolio->pullEventsOccurred());
        $this->eventBus->dispatch(...$allocation->pullEventsOccurred());
    }

}
