<?php

namespace FinizensChallenge\SharedContext\SharedModule\Domain\Exception;

use Exception;
use Throwable;

abstract class FinizensException extends Exception
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, static::errorCode(), $previous);
    }

    abstract protected static function errorCode(): string;
}
