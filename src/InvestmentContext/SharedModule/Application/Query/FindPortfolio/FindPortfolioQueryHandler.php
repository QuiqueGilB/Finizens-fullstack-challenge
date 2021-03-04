<?php

namespace FinizensChallenge\InvestmentContext\SharedModule\Application\Query\FindPortfolio;

use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\FindPortfolio\FindPortfolioByIdQuery;
use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\FindPortfolio\FindPortfolioByIdQueryHandler;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Exception\PortfolioNotFoundException;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\Exception\SharedPortfolioNotFoundException;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\Response\AllocationResponse;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\Response\PortfolioResponse;
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
            $portfolioQueryResponse = $this->findPortfolioByIdQueryHandler->handle(
                FindPortfolioByIdQuery::create($query->portfolioId())
            );

            /** @var \FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response\PortfolioResponse $portfolioResponse */
            $portfolioResponse = $portfolioQueryResponse->data()->value();

            $newAllocationResponse = $this->buildAllocationResponse($portfolioResponse);

            $newPortfolioResponse = new PortfolioResponse(
                $portfolioResponse->id(),
                ...$newAllocationResponse
            );

            return new QueryResponse(
                $newPortfolioResponse,
                $portfolioQueryResponse->metadata()
            );
        } catch (PortfolioNotFoundException $exception) {
            throw new SharedPortfolioNotFoundException("", 0, $exception);
        }
    }

    private function buildAllocationResponse(
        \FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response\PortfolioResponse $portfolioResponse
    ): array {
        $newAllocationResponse = array_map(
            static function ($oldAllocationResponse) {
                return new AllocationResponse($oldAllocationResponse->id(), $oldAllocationResponse->shares());
            },
            $portfolioResponse->allocations());
        return $newAllocationResponse;
    }

}
