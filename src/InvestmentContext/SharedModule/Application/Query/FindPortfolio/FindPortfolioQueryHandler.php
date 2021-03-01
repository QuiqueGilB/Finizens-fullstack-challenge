<?php

namespace FinizensChallenge\InvestmentContext\SharedModule\Application\Query\FindPortfolio;

use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\Find\FindPortfolioByIdQuery;
use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\Find\FindPortfolioByIdQueryHandler;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Exception\PortfolioNotFoundException;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\Exception\SharedPortfolioNotFoundException;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryResponse;

class FindPortfolioQueryHandler
{
    public function __construct(
        private FindPortfolioByIdQueryHandler $findPortfolioByIdQueryHandler
    ) {
    }

    public function handle(FindPortfolioQuery $query): QueryResponse
    {
        try {
            return $this->findPortfolioByIdQueryHandler->handle(
                FindPortfolioByIdQuery::create($query->portfolioId())
            );
        } catch (PortfolioNotFoundException $exception) {
            throw new SharedPortfolioNotFoundException("", 0, $exception);
        }
    }

}
