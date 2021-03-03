<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Infrastructure\Controllers\Api;

use FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Complete\CompleteOrderCommand;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\CommandBus;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Controller\BaseApiController;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Request\SymfonyRequestService;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response\EmptyResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostCompleteOrderController extends BaseApiController
{

    public function __construct(
        private CommandBus $commandBus,
        private SymfonyRequestService $symfonyRequestService
    ) {
    }

    #[Route("/complete", methods: ["POST"])]
    public function __invoke(
        Request $request
    ): Response {
        $command = CompleteOrderCommand::createFromArray(
            $this->symfonyRequestService->bodyJson($request)
        );

        $this->commandBus->handle($command);

        return new EmptyResponse(Response::HTTP_OK);
    }

}
