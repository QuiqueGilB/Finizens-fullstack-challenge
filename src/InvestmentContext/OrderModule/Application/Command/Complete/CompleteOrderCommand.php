<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Complete;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Command;

class CompleteOrderCommand extends Command
{

    public function orderId()
    {
        return $this->data['id'];
    }
}
