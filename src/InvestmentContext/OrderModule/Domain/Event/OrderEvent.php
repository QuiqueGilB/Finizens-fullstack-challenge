<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Event;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\Order;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;

abstract class OrderEvent extends Event
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    protected static function type(): string
    {
        return 'order';
    }
}
