<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

use JsonSerializable;
use QuiqueGilB\GlobalApiCriteria\QueryResponseModule\Data\Domain\ValueObject\QueryData as QuiqueGilBQueryData;

class QueryData extends QuiqueGilBQueryData implements JsonSerializable
{

    public function toPrimitives()
    {
        if (is_object($this->value()) || is_array($this->value())) {
            return new static(json_decode(json_encode($this->value()), true, 512, JSON_THROW_ON_ERROR));
        }
        return new static($this->value());
    }

    public function jsonSerialize()
    {
        return $this->value();
    }
}
