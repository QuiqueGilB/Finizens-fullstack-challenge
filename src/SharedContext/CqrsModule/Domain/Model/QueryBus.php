<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

interface QueryBus
{

    public function handle(Query $query): QueryResponse;

}
