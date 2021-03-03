<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Infrastructure\Controllers\Api;

use FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Create\CreateOrderCommand;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderType;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\CommandBus;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Controller\BaseApiController;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Request\SymfonyRequestService;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response\EmptyResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostBuyOrderController extends BaseApiController
{
    public function __construct(
        private CommandBus $commandBus,
        private SymfonyRequestService $symfonyRequestService
    ) {
    }

    #[Route("/buy", methods: ["POST"])]
    public function __invoke(
        Request $request
    ) {
        $payload = $this->symfonyRequestService->bodyJson($request);
        $payload['orderType'] = OrderType::buy()->value();

        $command = CreateOrderCommand::createFromArray($payload);
        $this->commandBus->handle($command);

        return new EmptyResponse(200);
    }

}
