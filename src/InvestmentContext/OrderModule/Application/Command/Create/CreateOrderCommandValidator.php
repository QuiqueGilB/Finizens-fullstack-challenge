<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Create;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\Order;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\OrderRepository;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderStatus;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderType;
use FinizensChallenge\InvestmentContext\SharedModule\Application\Query\FindPortfolio\FindPortfolioQuery;
use FinizensChallenge\InvestmentContext\SharedModule\Application\Query\FindPortfolio\FindPortfolioQueryHandler;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\ValidationException;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class CreateOrderCommandValidator
{

    public function validate(CreateOrderCommand $command): void
    {
        $this->validateId($command);
        $this->validatePortfolio($command);
        $this->validateAllocation($command);
        $this->validateShares($command);
    }

    private function validateId(CreateOrderCommand $command)
    {
        if (!is_int($command->data()['id'] ?? null)) {
            throw new ValidationException();
        }
    }

    private function validatePortfolio(CreateOrderCommand $command)
    {
        if (!is_int($command->data()['portfolio'] ?? null)) {
            throw new ValidationException();
        }
    }

    private function validateAllocation(CreateOrderCommand $command)
    {
        if (!is_int($command->data()['allocation'] ?? null)) {
            throw new ValidationException();
        }
    }

    private function validateShares(CreateOrderCommand $command)
    {
        if (!is_int($command->data()['shares'] ?? null)) {
            throw new ValidationException();
        }
    }

}
