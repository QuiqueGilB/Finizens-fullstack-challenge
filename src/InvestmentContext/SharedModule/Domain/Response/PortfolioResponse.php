<?php

namespace FinizensChallenge\InvestmentContext\SharedModule\Domain\Response;

class PortfolioResponse
{
    private int $id;
    private array $allocationResponses;

    public function __construct(int $id, AllocationResponse ...$allocationResponses)
    {
        $this->id = $id;
        $this->allocationResponses = $allocationResponses;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function allocationResponses(): array
    {
        return $this->allocationResponses;
    }
}
