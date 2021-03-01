<?php

namespace FinizensChallenge\SharedContext\SharedModule\Domain\Exception;

class ValidationException extends FinizensException
{
    protected static function errorCode(): string
    {
        return "VALIDATE_EXCEPTION";
    }
}
