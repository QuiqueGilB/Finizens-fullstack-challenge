<?php

namespace FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject;

use FinizensChallenge\SharedContext\SharedModule\Id\Domain\Exception\InvalidUuidException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid extends Id
{
    private string $value;

    public function __construct(string $value)
    {
        self::validate($value);
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function validate(string $value): void
    {
        if (!RamseyUuid::isValid($value)) {
            throw new InvalidUuidException();
        }
    }

    public static function create(string $uuid = null): static
    {
        return new static($uuid ?? RamseyUuid::uuid4()->toString());
    }


}
