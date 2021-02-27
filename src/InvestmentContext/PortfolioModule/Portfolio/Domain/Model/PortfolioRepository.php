<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Domain\Model;

use FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject\NumericId;

interface PortfolioRepository
{
    public function byId(NumericId $portfolioId): ?Portfolio;

    public function byIdOrFail(NumericId $portfolioId): Portfolio;

    public function save(Portfolio $portfolio): void;
}
