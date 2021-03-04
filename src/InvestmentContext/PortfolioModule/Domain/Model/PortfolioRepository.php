<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model;

use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

interface PortfolioRepository
{
    public function byId(NumericId $portfolioId): ?Portfolio;

    public function byIdOrFail(NumericId $portfolioId): Portfolio;

    public function allocationById(NumericId $allocationId): ?Allocation;

    public function save(Portfolio $portfolio): void;
}
