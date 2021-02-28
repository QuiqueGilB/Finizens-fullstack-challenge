<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\Find;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response\PortfolioResponse;
use FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model\QueryMetadata;
use FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model\QueryResponse;
use FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject\NumericId;

class FindPortfolioByIdQueryHandler
{
    public function __construct(
        private PortfolioRepository $portfolioRepository
    ) {
    }

    public function handle(FindPortfolioByIdQuery $query): QueryResponse
    {
        $portfolioId = new NumericId($query->portfolioId());

        $portfolio = $this->portfolioRepository->byIdOrFail($portfolioId);

        return new QueryResponse(
            PortfolioResponse::build($portfolio),
            QueryMetadata::create(0, 0, 1)
        );
    }

}