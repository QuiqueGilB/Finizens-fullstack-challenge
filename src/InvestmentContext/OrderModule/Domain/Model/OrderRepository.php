<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Model;

use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

interface OrderRepository
{
    public function byId(NumericId $orderId): ?Order;

    public function byIdOrFail(NumericId $orderId): Order;

    public function save(Order $order): void;
}
