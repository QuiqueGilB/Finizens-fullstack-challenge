<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\FindPortfolio;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Query;

class FindPortfolioByIdQuery extends Query
{

    public static function create($portfolioId): static
    {
        return parent::createFromArray([
            'portfolioId' => $portfolioId
        ]);
    }

    public function portfolioId(): string
    {
        return $this->data['portfolioId'];
    }

}
