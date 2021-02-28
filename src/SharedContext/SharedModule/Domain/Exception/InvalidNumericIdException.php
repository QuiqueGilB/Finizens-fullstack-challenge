<?php

namespace FinizensChallenge\SharedContext\SharedModule\Domain\Exception;

class InvalidNumericIdException extends InvalidIdException
{
    protected static function errorCode(): string
    {
        return 'INVALID_NUMERIC_ID_EXCEPTION';
    }
}
