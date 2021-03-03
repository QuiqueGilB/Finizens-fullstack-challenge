<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Portfolio;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;

abstract class PortfolioEvent extends Event
{
    public function __construct(Portfolio $portfolio)
    {
        parent::__construct($portfolio);
    }

    protected static function type(): string
    {
        return 'portfolio';
    }
}
