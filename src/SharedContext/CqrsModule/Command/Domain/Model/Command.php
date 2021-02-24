<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Command\Domain\Model;

use DateTimeImmutable;

class Command
{
    private array $data;
    private DateTimeImmutable $createdAt;

    public function __construct(array $data = [])
    {
        $this->data = $data;
        $this->createdAt = new DateTimeImmutable();
    }

}
