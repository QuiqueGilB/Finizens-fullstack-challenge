<?php

namespace FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response;

use Symfony\Component\HttpFoundation\Response;

class EmptyResponse extends Response
{
    public function __construct(int $status = Response::HTTP_NO_CONTENT, array $headers = [])
    {
        parent::__construct('', $status, $headers);
    }
}
