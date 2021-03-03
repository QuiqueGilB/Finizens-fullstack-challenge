<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Complete;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\ValidationException;

class CompleteOrderCommandValidator
{

    public function validate(CompleteOrderCommand $command): void
    {
        $this->validateId($command);
    }

    private function validateId(CompleteOrderCommand $command)
    {
        if (!is_int($command->data()['id'] ?? null)) {
            throw new ValidationException();
        }
    }

}
