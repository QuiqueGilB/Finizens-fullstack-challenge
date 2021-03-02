<?php

namespace FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response;

use Symfony\Component\HttpFoundation\Response;

class NotFoundResponse extends Response
{
    public function __construct(array $headers = [])
    {
        parent::__construct('', Response::HTTP_NOT_FOUND, $headers);
    }
}
