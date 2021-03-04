<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\FindPortfolio;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Exception\PortfolioNotFoundException;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response\PortfolioResponse;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryMetadata;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryResponse;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class FindPortfolioByIdQueryHandler
{
    public function __construct(
        private PortfolioRepository $portfolioRepository
    ) {
    }

    public function handle(FindPortfolioByIdQuery $query): QueryResponse
    {
        $portfolioId = new NumericId($query->portfolioId());

        $portfolio = $this->portfolioRepository->byId($portfolioId);

        if (null === $portfolio) {
            throw new PortfolioNotFoundException($portfolioId->value());
        }

        return new QueryResponse(
            PortfolioResponse::build($portfolio),
            QueryMetadata::create(0, 0, 1)
        );
    }

}
