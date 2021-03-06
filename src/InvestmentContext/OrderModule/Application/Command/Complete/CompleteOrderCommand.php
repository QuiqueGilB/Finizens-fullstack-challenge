<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Complete;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Command;

class CompleteOrderCommand extends Command
{
    public static function create($orderId): static
    {
        return self::createFromArray([
            'id' => $orderId
        ]);
    }

    public function orderId()
    {
        return $this->data['id'];
    }
}
