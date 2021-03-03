<?php

namespace FinizensChallenge\SharedContext\SharedModule\Infrastructure\Persistance\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\Uuid;

class UuidType extends StringType
{

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Uuid::create($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var Uuid $value */
        return $value->value();
    }

    public function getName(): string
    {
        return 'uuid';
    }

    public function getDefaultLength(AbstractPlatform $platform): int
    {
        return 36;
    }

}
