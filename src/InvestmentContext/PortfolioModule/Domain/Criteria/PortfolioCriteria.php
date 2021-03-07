<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Criteria;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Criteria;
use QuiqueGilB\GlobalApiCriteria\CriteriaModule\Criteria\Domain\ValueObject\FieldCriteriaRules;

class PortfolioCriteria extends Criteria
{

    protected static function createRules(): array
    {
        return [
            FieldCriteriaRules::create('createdAt')
                ->sortable(true)
        ];
    }
}
