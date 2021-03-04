<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\DeleteAllocation;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\ValidationException;

class DeleteAllocationCommandValidator
{
    public function validate(DeleteAllocationCommand $command): void
    {
        $this->validateAllocationId($command);

    }

    private function validateAllocationId(DeleteAllocationCommand $command)
    {
        if (!is_int($command->data()['id'])) {
            throw new ValidationException();
        }
    }
}
