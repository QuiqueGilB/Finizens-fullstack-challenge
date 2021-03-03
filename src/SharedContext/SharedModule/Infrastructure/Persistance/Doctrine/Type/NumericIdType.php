<?php

namespace FinizensChallenge\SharedContext\SharedModule\Infrastructure\Persistance\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class NumericIdType extends IntegerType
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return NumericId::create($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var NumericId $value */
        return $value?->value();
    }

    public function getName(): string
    {
        return 'numeric_id';
    }

}
