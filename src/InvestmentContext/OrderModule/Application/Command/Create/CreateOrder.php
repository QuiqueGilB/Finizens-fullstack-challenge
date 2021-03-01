<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Create;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Command;

class CreateOrder extends Command
{

    public function orderId(): string
    {
        return $this->data['id'];
    }

    public function portfolioId(): string
    {
        return $this->data['portfolio'];
    }

    public function shares(): int
    {
        return $this->data['shares'];
    }

    public function allocationId(): string
    {
        return $this->data['allocation'];
    }

    public function orderType(): string
    {
        return $this->data['type'];
    }
}
