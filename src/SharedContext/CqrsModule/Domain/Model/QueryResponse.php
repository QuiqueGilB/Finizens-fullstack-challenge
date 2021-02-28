<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

use QuiqueGilB\GlobalApiCriteria\QueryResponseModule\QueryResponse\Domain\ValueObject\QueryResponse as QuiqueGilBQueryResponse;

class QueryResponse extends QuiqueGilBQueryResponse
{

    public function __construct($data, QueryMetadata $metadata)
    {
        parent::__construct(QueryData::create($data), $metadata);
    }

}
