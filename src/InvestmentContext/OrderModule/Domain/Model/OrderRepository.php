<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Model;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Criteria\OrderCriteria;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

interface OrderRepository
{
    public function byId(NumericId $orderId): ?Order;

    public function byIdOrFail(NumericId $orderId): Order;

    public function save(Order $order): void;

    /**
     * @param OrderCriteria $criteria
     * @return Order[]
     */
    public function search(OrderCriteria $criteria): array;

    public function countSearch(OrderCriteria $criteria): int;
}
