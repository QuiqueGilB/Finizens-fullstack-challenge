<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Command\Infrastructure\Tactician;

use FinizensChallenge\SharedContext\CqrsModule\Command\Domain\Model\Command;
use FinizensChallenge\SharedContext\CqrsModule\Command\Domain\Model\CommandBus as CommandBusInterface;
use League\Tactician\CommandBus;

class TacticianCommandBus implements CommandBusInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function run(Command $command): void
    {
        $this->commandBus->handle($command);
    }
}
