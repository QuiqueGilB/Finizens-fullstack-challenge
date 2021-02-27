<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model;

interface QueryBus
{

    public function ask(Query $query): QueryResponse;

}
