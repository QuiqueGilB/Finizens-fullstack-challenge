<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model;

use JetBrains\PhpStorm\Pure;
use QuiqueGilB\GlobalApiCriteria\QueryResponseModule\Metadata\Domain\ValueObject\QueryMetadata as QuiqueGilBQueryMetadata;

class QueryMetadata extends QuiqueGilBQueryMetadata
{

    #[Pure] public static function unique(): static
    {
        return new static(0, 0, 1);
    }

    #[Pure] public static function create(int $offset, int $limit, int $total): static
    {
        return new static($offset, $limit, $total);
    }

}
