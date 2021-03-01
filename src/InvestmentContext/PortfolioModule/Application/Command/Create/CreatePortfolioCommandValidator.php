<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\Create;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\ValidationException;

class CreatePortfolioCommandValidator
{

    public function validate(CreatePortfolioCommand $command): void
    {
        $this->validateId($command);
        $this->validateAllocations($command);
    }

    private function validateId(CreatePortfolioCommand $command): void
    {
        if (!isset($command->data()['id'])) {
            throw new ValidationException();
        }
    }

    private function validateAllocations(CreatePortfolioCommand $command): void
    {
        $allocations = $command->data()['allocations'] ?? null;
        if (!is_array($allocations)) {
            throw new ValidationException();
        }

        foreach ($allocations as $allocation) {
            $this->validateAllocation($allocation);
        }
    }

    private function validateAllocation($allocation): void
    {
        if (
            is_array($allocation)
            && is_int($allocation['id'] ?? null)
            && is_int($allocation['shares'] ?? null)
        ) {
            return;
        }

        throw new ValidationException();
    }
}
