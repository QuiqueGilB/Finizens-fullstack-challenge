<?php

namespace FinizensChallenge\SharedContext\HttpModule\Infrastructure\Listener;

use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\ValidationException;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Throwable;

class MakeBodyOnJsonRequestListener
{

    public function onRequest(RequestEvent $event): void
    {
        if (false === $event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();

        if ($request->headers->contains('Content-Type', 'application/json')) {
            try {
                $payload = json_decode($request->getContent() ?: "{}", true, 512, JSON_THROW_ON_ERROR);
                $request->request->add($payload);

            } catch (Throwable $e) {
                throw new ValidationException("", 0, $e);
            }
        }
    }
}
