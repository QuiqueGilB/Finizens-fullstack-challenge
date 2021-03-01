<?php

namespace FinizensChallenge\SharedContext\HttpModule\Infrastructure\Listener;

use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response\EmptyResponse;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response\InvalidPayloadResponse;
use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\ValidationException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class MakeResponseOnExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        // TODO: Create ExceptionResolverService
        if ($event->getThrowable() instanceof MethodNotAllowedHttpException) {
            $event->setResponse(new EmptyResponse( 405));
        }

        if ($event->getThrowable() instanceof ValidationException) {
            $event->setResponse(new InvalidPayloadResponse());
        }
    }
}
