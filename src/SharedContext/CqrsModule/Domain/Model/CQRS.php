<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

use DateTime;
use DateTimeImmutable;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\Uuid;

abstract class CQRS
{
    private function __construct(
        protected Uuid $id,
        protected array $data,
        protected DateTimeImmutable $createdAt
    ) {
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->id->value(),
            'data' => $this->data,
            'createdAt' => $this->createdAt->format(DateTime::ATOM)
        ];
    }

    public static function createFromArray(array $data = null): static
    {
        return new static(
            Uuid::create(),
            $data ?? [],
            new DateTimeImmutable()
        );
    }

    public static function instanceFromPayload(array $payload): static
    {
        return new static(
            Uuid::create($payload['id']),
            $payload['data'],
            new DateTimeImmutable($payload['createdAt'])
        );
    }

}
