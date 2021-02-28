<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Infrastructure\Tactician;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Query;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryBus;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryResponse;
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
