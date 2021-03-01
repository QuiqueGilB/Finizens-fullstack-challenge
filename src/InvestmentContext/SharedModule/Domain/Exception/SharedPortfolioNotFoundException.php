<?php

namespace FinizensChallenge\InvestmentContext\SharedModule\Domain\Exception;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\FinizensException;

class SharedPortfolioNotFoundException extends FinizensException
{
    protected static function errorCode(): string
    {
        return 'PORTFOLIO_NOT_FOUND_EXCEPTION';
    }
}
