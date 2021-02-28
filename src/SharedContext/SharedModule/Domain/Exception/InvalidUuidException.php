<?php

namespace FinizensChallenge\SharedContext\SharedModule\Domain\Exception;

class InvalidUuidException extends InvalidIdException
{
    protected static function errorCode(): string
    {
        return 'INVALID_UUID_EXCEPTION';
    }

}
