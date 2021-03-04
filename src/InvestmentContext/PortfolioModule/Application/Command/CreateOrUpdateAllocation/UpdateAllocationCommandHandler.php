<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\CreateOrUpdateAllocation;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\AllocationNotFoundException;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Exception\PortfolioNotFoundException;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\EventBus;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class UpdateAllocationCommandHandler
{
    public function __construct(
        private PortfolioRepository $portfolioRepository,
        private EventBus $eventBus
    ) {
    }

    public function handle(UpdateAllocationCommand $command): void
    {
        $portfolioId = new NumericId($command->portfolioId());
        $allocationId = new NumericId($command->allocationId());
        $shares = new Shares($command->shares());

        $portfolio = $this->portfolioRepository->byId($portfolioId);

        if (null === $portfolio) {
            throw new PortfolioNotFoundException($portfolioId->value());
        }

        $allocation = $portfolio->createOrUpdateAllocation(
            $allocationId,
            $shares
        );

        $this->portfolioRepository->save($portfolio);

        $this->eventBus->dispatch(...$portfolio->eventsOccurred());
        $this->eventBus->dispatch(...$allocation->eventsOccurred());
    }

}
