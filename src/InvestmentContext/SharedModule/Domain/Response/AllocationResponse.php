<?php

namespace FinizensChallenge\InvestmentContext\SharedModule\Domain\Response;

class AllocationResponse
{
    public function __construct(
        private int $id,
        private int $shares
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function shares(): int
    {
        return $this->shares;
    }
}
