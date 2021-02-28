<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

use JetBrains\PhpStorm\Pure;
use JsonSerializable;
use QuiqueGilB\GlobalApiCriteria\QueryResponseModule\Data\Domain\ValueObject\QueryData as QuiqueGilBQueryData;

class QueryData extends QuiqueGilBQueryData implements JsonSerializable
{

    #[Pure] public function jsonSerialize()
    {
        return $this->value();
    }
}
