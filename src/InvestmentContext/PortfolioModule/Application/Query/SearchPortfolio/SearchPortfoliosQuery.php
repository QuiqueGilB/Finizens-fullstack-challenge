<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\SearchPortfolio;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Query;

class SearchPortfoliosQuery extends Query
{

    public static function create($filters, $order, $offset, $limit): static
    {
        return static::createFromArray([
            'filters' => $filters,
            'order' => $order,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

}
