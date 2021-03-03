<?php

namespace FinizensChallenge\SharedContext\EventModule\Infrastructure\Messenger;

use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\EventBus;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SymfonyEventDispatcherBus implements EventBus
{
    public function __construct(private EventDispatcherInterface $eventDispatcher)
    {
    }

    public function dispatch(Event ...$events): void
    {
        foreach ($events as $event) {
            $this->eventDispatcher->dispatch($event, $event::eventName());
        }
    }
}
