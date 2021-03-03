<?php

namespace FinizensChallenge\SharedContext\EventModule\Domain\Model;

trait WithEvents
{
    private array $eventsOccurred = [];

    public function publishEvent(Event $event): void
    {
        $this->eventsOccurred[] = $event;
    }

    public function eventsOccurred(): array
    {
        return $this->eventsOccurred;
    }
}
