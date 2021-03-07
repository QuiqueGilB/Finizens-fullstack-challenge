<?php

namespace FinizensChallenge\SharedContext\HttpModule\Infrastructure\Listener;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\AllocationNotFoundException;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\OrderAllocationExceededSharesLimitException;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\OrderNotFoundException;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Exception\PortfolioNotFoundException;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\Exception\SharedPortfolioNotFoundException;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response\EmptyResponse;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response\InvalidPayloadResponse;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response\NotFoundResponse;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response\ServerErrorResponse;
use FinizensChallenge\SharedContext\SharedModule\Domain\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class MakeResponseOnExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        // TODO: Create ExceptionResolverService

        $response = match (get_class($event->getThrowable())) {
            MethodNotAllowedHttpException::class => new EmptyResponse(Response::HTTP_METHOD_NOT_ALLOWED),

            ValidationException::class => new InvalidPayloadResponse(),

            PortfolioNotFoundException::class,
            SharedPortfolioNotFoundException::class,
            OrderNotFoundException::class,
            AllocationNotFoundException::class => new NotFoundResponse(),

            OrderAllocationExceededSharesLimitException::class => new ServerErrorResponse(),
            default => $event->getResponse()
        };

        if (null !== $response) {
            $event->setResponse($response);
        }
    }
}
