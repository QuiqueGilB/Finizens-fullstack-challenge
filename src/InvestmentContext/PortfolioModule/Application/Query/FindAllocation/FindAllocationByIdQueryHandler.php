<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\FindAllocation;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\AllocationNotFoundException;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response\AllocationResponse;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response\PortfolioResponse;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryMetadata;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryResponse;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class FindAllocationByIdQueryHandler
{
    public function __construct(
        private PortfolioRepository $portfolioRepository
    ) {
    }

    public function handle(FindAllocationByIdQuery $query): QueryResponse
    {
        $allocationId = new NumericId($query->allocationId());

        $allocation = $this->portfolioRepository->allocationById($allocationId);

        if (null === $allocation) {
            throw new AllocationNotFoundException($allocationId->value());
        }

        return new QueryResponse(
            AllocationResponse::build($allocation),
            QueryMetadata::create(0, 0, 1)
        );
    }

}
