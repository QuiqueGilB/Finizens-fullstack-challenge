<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Application\Query\Find;

use FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model\Query;

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
