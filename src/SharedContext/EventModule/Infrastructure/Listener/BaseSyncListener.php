<?php

namespace FinizensChallenge\SharedContext\EventModule\Infrastructure\Listener;

use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class BaseSyncListener implements EventSubscriberInterface
{
    abstract public static function subscribedTo(): array;

    abstract public function __invoke(Event $event): void;

    public static function getSubscribedEvents(): iterable
    {
        foreach (static::subscribedTo() as $eventName) {
            yield $eventName => '__invoke';
        }
    }
}
