<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Event;

class OrderDeleted extends OrderEvent
{
    protected static function action(): string
    {
        return 'deleted';
    }
}
