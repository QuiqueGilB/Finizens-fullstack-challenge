<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\InvalidOrderStatusException;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\ValueObject;

class OrderStatus extends ValueObject
{
    private const ACCEPTED = [
        'pending' => 'pending',
        'completed' => 'completed'
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
            throw new InvalidOrderStatusException($value);
        }
    }

    public static function pending(): static
    {
        return new static(self::ACCEPTED['pending']);
    }

    public static function completed(): static
    {
        return new static(self::ACCEPTED['completed']);
    }

    public function isPending(): bool
    {
        return $this->equal(self::pending());
    }

    public function isCompleted(): bool
    {
        return $this->equal(self::completed());
    }

    public function equal(OrderStatus $orderStatus): bool
    {
        return $this->value === $orderStatus->value();
    }
}
