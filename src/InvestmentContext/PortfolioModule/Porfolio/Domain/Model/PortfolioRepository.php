<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Porfolio\Domain\Model;

use FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject\Id;

interface PortfolioRepository
{
    public function byId(Id $portfolioId): ?Portfolio;

    public function save(Portfolio $portfolio): void;
}
