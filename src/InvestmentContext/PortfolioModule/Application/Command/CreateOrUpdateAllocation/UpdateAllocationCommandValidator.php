<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\CreateOrUpdateAllocation;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\ValidationException;

class UpdateAllocationCommandValidator
{
    public function validate(UpdateAllocationCommand $command)
    {
        $this->validatePortfolioId($command);
        $this->validateAllocationId($command);
        $this->validateShares($command);
    }

    private function validatePortfolioId(UpdateAllocationCommand $command)
    {
        if (!is_int($command->data()['portfolioId'] ?? null)) {
            throw new ValidationException();
        }
    }

    private function validateShares(UpdateAllocationCommand $command)
    {
        if (!is_int($command->data()['allocationId'] ?? null)) {
            throw new ValidationException();
        }
    }

    private function validateAllocationId(UpdateAllocationCommand $command)
    {
        if (!is_int($command->data()['shares'] ?? null)) {
            throw new ValidationException();
        }
    }
}
