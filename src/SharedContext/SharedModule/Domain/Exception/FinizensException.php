<?php

namespace FinizensChallenge\SharedContext\SharedModule\Domain\Exception;

use Exception;
use Throwable;

abstract class FinizensException extends Exception
{
    abstract protected static function errorCode(): string;
}
