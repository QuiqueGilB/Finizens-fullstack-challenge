<?php

namespace FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject;

use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\ValueObject;

class Shares extends ValueObject
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
