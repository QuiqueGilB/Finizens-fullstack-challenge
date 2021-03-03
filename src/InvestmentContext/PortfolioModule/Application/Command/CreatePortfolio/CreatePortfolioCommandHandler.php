<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\CreatePortfolio;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Allocation;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Portfolio;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\EventBus;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class CreatePortfolioCommandHandler
{
    public function __construct(
        private PortfolioRepository $portfolioRepository,
        private EventBus $eventBus
    ) {
    }

    public function handle(CreatePortfolioCommand $command): void
    {
        $portfolioId = NumericId::create($command->portfolioId());

        $portfolio = $this->portfolioRepository->byId($portfolioId);

        if(null === $portfolio) {
            $portfolio = new Portfolio($portfolioId);
        }

        $allocations = $this->buildAllocations($portfolio, $command->allocations());
        $portfolio->update(...$allocations);

        $this->portfolioRepository->save($portfolio);
        $this->dispatchEvents($portfolio);
    }

    private function buildAllocations(Portfolio $portfolio, array $allocations): array
    {
        return array_map(static function (array $allocation) use ($portfolio) {
            return new Allocation(
                NumericId::create($allocation['id']),
                $portfolio,
                new Shares($allocation['shares'])
            );
        },
            $allocations);
    }

    private function dispatchEvents(Portfolio $portfolio): void
    {
        $this->eventBus->dispatch(...$portfolio->eventsOccurred());
        foreach ($portfolio->allocations() as $allocation) {
            $this->eventBus->dispatch(...$allocation->eventsOccurred());
        }
    }

}
