<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Porfolio\Application\Command\Create;

use FinizensChallenge\InvestmentContext\PortfolioModule\Porfolio\Domain\Model\PortfolioRepository;

class CreatePortfolioCommandHandler
{
    public function __construct(PortfolioRepository $portfolioRepository)
    {
    }

    public function handle(CreatePortfolioCommand $command): void
    {

    }

}
