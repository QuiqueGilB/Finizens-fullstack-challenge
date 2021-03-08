<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event;

class PortfolioCleaned extends PortfolioEvent
{
    protected static function action(): string
    {
        return 'cleaned';
    }
}
