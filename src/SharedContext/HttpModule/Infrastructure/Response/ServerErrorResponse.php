<?php

namespace FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response;

use Symfony\Component\HttpFoundation\Response;

class ServerErrorResponse extends Response
{
    public function __construct(int $status = Response::HTTP_INTERNAL_SERVER_ERROR, array $headers = [])
    {
        parent::__construct('', $status, $headers);
    }
}
