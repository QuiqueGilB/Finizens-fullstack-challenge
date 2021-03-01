<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\FinizensException;

class InvalidOrderTypeException extends FinizensException
{
    protected static function errorCode(): string
    {
        return 'INVALID_ORDER_TYPE_EXCEPTION';
    }

}
