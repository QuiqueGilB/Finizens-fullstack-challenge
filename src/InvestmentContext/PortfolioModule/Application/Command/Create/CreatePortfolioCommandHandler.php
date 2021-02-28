<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\Create;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Allocation;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Portfolio;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class CreatePortfolioCommandHandler
{
    public function __construct(
        private PortfolioRepository $portfolioRepository
    ) {
    }

    public function handle(CreatePortfolioCommand $command): void
    {
        $portfolioId = NumericId::create($command->portfolioId());

        $portfolio = new Portfolio($portfolioId);
        $allocations = $this->buildAllocations($portfolio, $command->allocations());
        $portfolio->update(...$allocations);

        $this->portfolioRepository->save($portfolio);
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

}
