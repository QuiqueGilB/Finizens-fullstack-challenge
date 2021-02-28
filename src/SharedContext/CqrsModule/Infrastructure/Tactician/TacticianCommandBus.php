<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Infrastructure\Tactician;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Command;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\CommandBus as CommandBusInterface;
use League\Tactician\CommandBus;

class TacticianCommandBus implements CommandBusInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handle(Command $command): void
    {
        $this->commandBus->handle($command);
    }
}
