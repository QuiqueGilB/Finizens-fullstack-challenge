<?php

namespace FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response;

use Symfony\Component\HttpFoundation\Response;

class InvalidPayloadResponse extends Response
{
    public function __construct(int $status = 400, array $headers = [])
    {
        parent::__construct('', $status, $headers);
    }
}
