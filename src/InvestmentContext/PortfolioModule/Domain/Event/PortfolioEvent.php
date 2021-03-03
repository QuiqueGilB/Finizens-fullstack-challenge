<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Portfolio;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;

abstract class PortfolioEvent extends Event
{
    public function __construct(Portfolio $portfolio)
    {
        parent::__construct([
            'id' => $portfolio->id()->value(),
            'createdAt' => $portfolio->createdAt()->format(DATE_ATOM),
            'updatedAt' => $portfolio->createdAt()->format(DATE_ATOM)
        ]);
    }

    protected static function type(): string
    {
        return 'portfolio';
    }
}
