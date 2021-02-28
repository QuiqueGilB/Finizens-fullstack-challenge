<?php

namespace FinizensChallenge\SharedContext\HttpModule\Response\Infrastructure\Listener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class MakeResponseOnExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        // TODO: Create ExceptionResolverService
        if ($event->getThrowable() instanceof MethodNotAllowedHttpException) {
            $event->setResponse(new Response("", 405));
        }
    }
}
