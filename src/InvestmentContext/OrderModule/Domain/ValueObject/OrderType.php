<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\InvalidOrderTypeException;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\ValueObject;

class OrderType extends ValueObject
{
    private const ACCEPTED = [
        'buy' => 'buy',
        'sell' => 'sell'
    ];

    private string $value;

    public function __construct(string $value)
    {
        static::validate($value);
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function validate(string $value): void
    {
        if (!in_array($value, self::ACCEPTED)) {
            throw new InvalidOrderTypeException($value);
        }
    }

    public static function buy(): static
    {
        return new static(self::ACCEPTED['buy']);
    }

    public static function sell(): static
    {
        return new static(self::ACCEPTED['sell']);
    }

    public function isBuy():bool {
        return $this->value === self::buy()->value();
    }

    public function isSell():bool {
        return $this->value === self::sell()->value();
    }
}
