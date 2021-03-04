<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\FindAllocation;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Query;

class FindAllocationByIdQuery extends Query
{

    public static function create($allocationId): static
    {
        return parent::createFromArray([
            'allocationId' => $allocationId
        ]);
    }

    public function allocationId(): string
    {
        return $this->data['allocationId'];
    }


}
