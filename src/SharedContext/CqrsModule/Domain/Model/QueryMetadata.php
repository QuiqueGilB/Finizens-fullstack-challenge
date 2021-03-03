<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

use JsonSerializable;
use QuiqueGilB\GlobalApiCriteria\QueryResponseModule\Metadata\Domain\ValueObject\QueryMetadata as QuiqueGilBQueryMetadata;

class QueryMetadata extends QuiqueGilBQueryMetadata implements JsonSerializable
{

    public static function unique(): static
    {
        return new static(0, 0, 1);
    }

    public static function create(int $offset, int $limit, int $total): static
    {
        return new static($offset, $limit, $total);
    }

    public function jsonSerialize()
    {
        return [
            'offset' => $this->offset(),
            'limit' => $this->limit(),
            'items' => $this->items(),
            'total' => $this->total(),
        ];
    }
}
