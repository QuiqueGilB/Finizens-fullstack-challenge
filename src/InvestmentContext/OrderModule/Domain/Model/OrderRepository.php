<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Model;

use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

interface OrderRepository
{
    public function byId(NumericId $orderId);

    public function byIdOrFail(NumericId $orderId);

    public function save(Order $order);
}
