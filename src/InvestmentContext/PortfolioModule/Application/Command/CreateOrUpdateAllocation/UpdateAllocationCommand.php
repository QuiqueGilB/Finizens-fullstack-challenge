<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\CreateOrUpdateAllocation;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Command;

class UpdateAllocationCommand extends Command
{

    public static function create($portfolioId, $allocationId, $shares)
    {
        return static::createFromArray([
            'portfolioId' => $portfolioId,
            'allocationId' => $allocationId,
            'shares' => $shares,
        ]);
    }

    public function portfolioId(): int
    {
        return $this->data['portfolioId'];
    }

    public function allocationId(): int
    {
        return $this->data['allocationId'];
    }

    public function shares(): int
    {
        return $this->data['shares'];
    }

}
