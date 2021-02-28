<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Infrastructure\Controllers\Api;

use FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Application\Command\Create\CreatePortfolioCommand;
use FinizensChallenge\SharedContext\CqrsModule\Command\Domain\Model\CommandBus;
use FinizensChallenge\SharedContext\HttpModule\Controller\Infrastructure\Controllers\BaseApiController;
use FinizensChallenge\SharedContext\HttpModule\Request\Infrastructure\Request\SymfonyRequestService;
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
