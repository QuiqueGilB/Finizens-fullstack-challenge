<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Infrastructure\Controllers\Api;

use FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Create\CreateOrderCommand;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderType;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Controller\BaseApiController;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response\EmptyResponse;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostSellOrderController extends BaseApiController
{
    public function __construct(
        private CommandBus $commandBus
    ) {
    }

    #[Route("/sell", methods: ["POST"])]
    public function __invoke(
        Request $request
    ) {
        $payload = $request->request->all();
        $payload['orderType'] = OrderType::sell()->value();

        $command = CreateOrderCommand::createFromArray($payload);
        $this->commandBus->handle($command);

        return new EmptyResponse(200);
    }

}
