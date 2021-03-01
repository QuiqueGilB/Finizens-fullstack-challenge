<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\FinizensException;

class InvalidOrderStatusException extends FinizensException
{
    protected static function errorCode(): string
    {
        return 'INVALID_ORDER_STATUS_EXCEPTION';
    }

}
