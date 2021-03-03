<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event;

class AllocationUpdated extends AllocationEvent
{
    protected static function action(): string
    {
        return 'created';
    }
}
