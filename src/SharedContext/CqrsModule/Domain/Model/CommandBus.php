<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

interface CommandBus
{

    public function handle(Command $command): void;

}
