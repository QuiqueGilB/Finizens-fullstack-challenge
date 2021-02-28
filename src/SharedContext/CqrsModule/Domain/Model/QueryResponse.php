<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

use JsonSerializable;
use QuiqueGilB\GlobalApiCriteria\QueryResponseModule\QueryResponse\Domain\ValueObject\QueryResponse as QuiqueGilBQueryResponse;

class QueryResponse extends QuiqueGilBQueryResponse implements JsonSerializable
{

    public function __construct($data, QueryMetadata $metadata)
    {
        parent::__construct(QueryData::create($data), $metadata);
    }

    public function jsonSerialize(): array
    {
        return [
            'data' => $this->data(),
            'meta' => $this->metadata()
        ];
    }

}
