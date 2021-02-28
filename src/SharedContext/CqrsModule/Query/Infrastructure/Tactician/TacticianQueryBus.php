<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Query\Infrastructure\Tactician;

use FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model\Query;
use FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model\QueryBus;
use FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model\QueryResponse;
use League\Tactician\CommandBus;

class TacticianQueryBus implements QueryBus
{
    private CommandBus $queryBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->queryBus = $commandBus;
    }

    public function handle(Query $query): QueryResponse
    {
        return $this->queryBus->handle($query);
    }
}
