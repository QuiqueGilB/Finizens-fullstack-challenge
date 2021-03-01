<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Infrastructure\Tactician\Middleware;

use League\Tactician\Middleware;

class ValidatorMiddleware implements Middleware
{
    public function execute($command, callable $next)
    {
        $validatorClass = get_class($command) . 'Validator';

        if(class_exists($validatorClass)) {
            $validator = new $validatorClass;
            $validator->validate($command);
        }

        $response = $next($command);

        return $response;
    }


}
