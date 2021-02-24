<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model;

interface QueryBus
{

    public function handle(Query $query): QueryResponse;

}
