<?php

namespace FinizensChallenge\SharedContext\HttpModule\Infrastructure\Request;

use Symfony\Component\HttpFoundation\Request;

class SymfonyRequestService
{
    public function bodyJson(Request $request): array
    {
        try {
            return json_decode(
                $request->getContent(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\Throwable $e) {
            return [];
        }
    }
}
