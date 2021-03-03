<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Event;

class OrderCreated extends OrderEvent
{
    protected static function action(): string
    {
        return 'created';
    }
}
