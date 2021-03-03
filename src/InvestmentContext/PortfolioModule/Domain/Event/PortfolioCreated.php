<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event;

class PortfolioCreated extends PortfolioEvent
{
    protected static function action(): string
    {
        return 'created';
    }
}
