<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Porfolio\Domain\ValueObject;

use FinizensChallenge\SharedContext\SharedModule\Shared\Domain\ValueObject\ValueObject;

class Shares extends ValueObject
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

}
