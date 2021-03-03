<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event;

class AllocationCreated extends AllocationEvent
{
    protected static function action(): string
    {
        return 'created';
    }
}
