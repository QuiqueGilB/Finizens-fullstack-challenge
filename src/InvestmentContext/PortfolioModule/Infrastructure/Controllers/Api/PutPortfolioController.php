<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Infrastructure\Controllers\Api;

use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\Create\CreatePortfolioCommand;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\CommandBus;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Controller\BaseApiController;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Request\SymfonyRequestService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PutPortfolioController extends BaseApiController
{
    public function __construct(
        private CommandBus $commandBus
    ) {
    }

    #[Route("/portfolio", methods: ["PUT"])]
    public function __invoke(
        Request $request,
        SymfonyRequestService $symfonyRequestService
    ): Response {

        $command = CreatePortfolioCommand::createFromArray(
            $symfonyRequestService->bodyJson($request)
        );

        $this->commandBus->handle($command);

        return new Response("");
    }
}
