<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Event;

class OrderCompleted extends OrderEvent
{
    protected static function action(): string
    {
        return 'completed';
    }
}
