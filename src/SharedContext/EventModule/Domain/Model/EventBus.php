<?php

namespace FinizensChallenge\SharedContext\EventModule\Domain\Model;

interface EventBus
{

    public function dispatch(Event $event): void;

}
