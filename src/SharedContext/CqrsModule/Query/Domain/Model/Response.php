<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model;

abstract class Response
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

}
