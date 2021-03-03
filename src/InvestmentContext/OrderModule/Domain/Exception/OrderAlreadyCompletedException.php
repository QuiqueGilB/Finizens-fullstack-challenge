<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\FinizensException;

class OrderAlreadyCompletedException extends FinizensException
{
    protected static function errorCode(): string
    {
        return 'ORDER_ALREADY_COMPLETED_EXCEPTION';
    }
}
