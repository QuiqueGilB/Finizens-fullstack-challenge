<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\Create;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Portfolio;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject\NumericId;

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

        $this->portfolioRepository->save($portfolio);
    }

}
