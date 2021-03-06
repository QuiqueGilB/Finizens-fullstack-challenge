<?php

namespace FinizensChallenge\SharedContext\EventModule\Domain\Model;

use DateTimeImmutable;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\Uuid;
use JsonSerializable;

abstract class Event implements JsonSerializable
{
    private Uuid $id;
    private array $data;
    private DateTimeImmutable $occurredOn;

    protected function __construct(array $data = [])
    {
        $this->id = Uuid::create();
        $this->data = $data;
        $this->occurredOn = new DateTimeImmutable();
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function occurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }

    abstract protected static function type(): string;

    abstract protected static function action(): string;

    public static function eventName(): string
    {
        $namespace = array_slice(explode("\\", static::class), 0, 3);
        $namespace[] = static::type();
        $namespace[] = static::action();

        return strtolower(implode('.', $namespace));
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->value(),
            'eventName' => static::eventName(),
            'data' => $this->data,
            'occurredOn' => $this->occurredOn->format(DateTimeImmutable::ATOM)
        ];
    }


}
