<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\DeleteAllocation;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Command;

class DeleteAllocationCommand extends Command
{

    public static function create($allocationId): static
    {
        return static::createFromArray([
            'id' => $allocationId
        ]);
    }

    public function allocationId(): int
    {
        return $this->data['id'];
    }
}
