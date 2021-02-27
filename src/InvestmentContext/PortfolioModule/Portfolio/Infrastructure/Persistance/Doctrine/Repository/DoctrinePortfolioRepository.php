<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Infrastructure\Persistance\Doctrine\Repository;

use FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Domain\Model\Portfolio;
use FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Domain\Model\PortfolioRepository;
use FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject\NumericId;

class DoctrinePortfolioRepository implements PortfolioRepository
{
    public function byId(NumericId $portfolioId): ?Portfolio
    {
        // TODO: Implement byId() method.
    }

    public function byIdOrFail(NumericId $portfolioId): Portfolio
    {
        // TODO: Implement byIdOrFail() method.
    }

    public function save(Portfolio $portfolio): void
    {
        // TODO: Implement save() method.
    }


}
