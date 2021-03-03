<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Allocation;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;

abstract class AllocationEvent extends Event
{
    public function __construct(Allocation $allocation)
    {
        parent::__construct([
            'id' => $allocation->id()->value(),
            'portfolio' => [
                'id' => $allocation->portfolio()->id()->value()
            ],
            'updatedAt' => $allocation->createdAt()->format(DATE_ATOM),
            'createdAt' => $allocation->createdAt()->format(DATE_ATOM)
        ]);
    }

    protected static function type(): string
    {
        return 'allocation';
    }
}
