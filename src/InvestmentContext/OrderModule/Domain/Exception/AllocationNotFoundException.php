<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\FinizensException;

class AllocationNotFoundException extends FinizensException
{
    protected static function errorCode(): string
    {
        return 'ALLOCATION_NOT_FOUND_EXCEPTION';
    }
}
