<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\FinizensException;

class OrderAllocationExceededSharesLimitException extends FinizensException
{
    protected static function errorCode(): string
    {
        return 'ORDER_ALLOCATION_EXCEEDED';
    }
}
