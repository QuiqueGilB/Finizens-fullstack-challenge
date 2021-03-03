<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Event;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\Order;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;

abstract class OrderEvent extends Event
{
    public function __construct(Order $order)
    {
        parent::__construct([
            'id' => $order->id()->value(),
            'portfolioId' => $order->allocationId()->value(),
            'allocationId' => $order->allocationId()->value(),
            'shares' => $order->shares()->value(),
            'orderType' => $order->orderType()->value(),
            'orderStatus' => $order->orderStatus()->value(),
            'updatedAt' => $order->createdAt()->format(DATE_ATOM),
            'createdAt' => $order->createdAt()->format(DATE_ATOM)
        ]);
    }

    protected static function type(): string
    {
        return 'order';
    }
}
