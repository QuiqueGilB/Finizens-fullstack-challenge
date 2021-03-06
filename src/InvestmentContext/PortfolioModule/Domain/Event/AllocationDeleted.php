<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event;

class AllocationDeleted extends AllocationEvent
{
    protected static function action(): string
    {
        return 'deleted';
    }

}
