<?php

namespace FinizensChallenge\SharedContext\SharedModule\Id\Domain\Exception;

class InvalidNumericIdException extends InvalidIdException
{
    protected static function errorCode(): string
    {
        return 'INVALID_NUMERIC_ID_EXCEPTION';
    }
}
