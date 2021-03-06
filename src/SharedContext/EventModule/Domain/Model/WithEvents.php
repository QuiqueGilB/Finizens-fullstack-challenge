<?php

namespace FinizensChallenge\SharedContext\EventModule\Domain\Model;

trait WithEvents
{
    private array $eventsOccurred = [];

    public function publishEvent(Event $event): void
    {
        $this->eventsOccurred[] = $event;
    }

    public function pullEventsOccurred(): array
    {
        $eventsOccurred = $this->eventsOccurred;
        $this->eventsOccurred = [];

        return $eventsOccurred;
    }
}
