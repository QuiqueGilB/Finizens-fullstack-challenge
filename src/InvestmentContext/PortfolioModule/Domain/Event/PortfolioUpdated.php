<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event;

class PortfolioUpdated extends PortfolioEvent
{
    protected static function action(): string
    {
        return 'updated';
    }
}
