<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Exception;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\FinizensException;

class PortfolioNotFoundException extends FinizensException
{
    protected static function errorCode(): string
    {
        return 'PORTFOLIO_NOT_FOUND';
    }

}
