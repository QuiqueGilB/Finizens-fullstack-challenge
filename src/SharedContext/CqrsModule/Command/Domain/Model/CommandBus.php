<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Command\Domain\Model;

interface CommandBus
{

    public function handle(Command $command): void;

}
