<?php

namespace FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject;

use FinizensChallenge\SharedContext\SharedModule\Id\Domain\Exception\InvalidNumericIdException;

class NumericId extends Id
{
    private int $value;

    public function __construct(int $id)
    {
        static::validate($id);
        $this->value = $id;
    }

    public function value(): int
    {
        return $this->value;
    }

    public static function validate(int $id): void
    {
        if (0 >= $id) {
            throw new InvalidNumericIdException($id);
        }
    }

    public static function create(int $id = null): static
    {
        return new static($id ?? mt_rand(1));
    }
}
