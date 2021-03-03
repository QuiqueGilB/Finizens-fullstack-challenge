<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

use JsonSerializable;

abstract class Response implements JsonSerializable
{

    abstract public static function build($model): static;

    public static function buildCollection(array $models): array
    {
        $response = [];
        foreach ($models as $model) {
            $response[] = static::build($model);
        }

        return $response;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


    public function view(): object
    {
        return (object)$this;
    }
}
