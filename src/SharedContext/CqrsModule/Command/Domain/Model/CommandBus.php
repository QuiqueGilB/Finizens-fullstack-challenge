<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Command\Domain\Model;

interface CommandBus
{

    public function run(Command $command): void;

}
