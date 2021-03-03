<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Event;

class OrderUpdated extends OrderEvent
{
    protected static function action(): string
    {
        return 'created';
    }
}
