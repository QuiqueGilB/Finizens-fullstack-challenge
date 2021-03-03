<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Allocation;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;

abstract class AllocationEvent extends Event
{
    public function __construct(Allocation $allocation)
    {
        parent::__construct($allocation);
    }

    protected static function type(): string
    {
        return 'portfolio';
    }
}
