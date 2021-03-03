<?php

namespace FinizensChallenge\SharedContext\EventModule\Domain\Model;

interface EventBus
{

    public function dispatch(Event ...$events): void;

}
