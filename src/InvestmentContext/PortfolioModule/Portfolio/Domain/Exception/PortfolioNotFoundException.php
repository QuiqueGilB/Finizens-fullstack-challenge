<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Domain\Exception;

use FinizensChallenge\SharedContext\SharedModule\Shared\Domain\Exception\FinizensException;

class PortfolioNotFoundException extends FinizensException
{
    protected static function errorCode(): string
    {
        return 'PORTFOLIO_NOT_FOUND';
    }

}
