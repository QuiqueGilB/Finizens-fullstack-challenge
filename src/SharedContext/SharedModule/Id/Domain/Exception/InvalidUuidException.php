<?php

namespace FinizensChallenge\SharedContext\SharedModule\Id\Domain\Exception;

class InvalidUuidException extends InvalidIdException
{
    protected static function errorCode(): string
    {
        return 'INVALID_UUID_EXCEPTION';
    }

}
