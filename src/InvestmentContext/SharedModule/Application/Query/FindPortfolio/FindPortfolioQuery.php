<?php

namespace FinizensChallenge\InvestmentContext\SharedModule\Application\Query\FindPortfolio;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Query;

class FindPortfolioQuery extends Query
{

    public static function create(string $portfolioId): static
    {
        return static::createFromArray([
            'portfolioId' => $portfolioId
        ]);
    }

    public function portfolioId(): string
    {
        return $this->data['portfolioId'];
    }

}
