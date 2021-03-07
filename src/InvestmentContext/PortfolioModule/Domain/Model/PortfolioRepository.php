<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Criteria\PortfolioCriteria;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

interface PortfolioRepository
{
    public function byId(NumericId $portfolioId): ?Portfolio;

    public function byIdOrFail(NumericId $portfolioId): Portfolio;

    public function allocationById(NumericId $allocationId): ?Allocation;

    public function save(Portfolio $portfolio): void;

    /**
     * @param PortfolioCriteria $portfolioCriteria
     * @return Portfolio[]
     */
    public function search(PortfolioCriteria $portfolioCriteria): array;

    public function countSearch(PortfolioCriteria $portfolioCriteria): int;
}
