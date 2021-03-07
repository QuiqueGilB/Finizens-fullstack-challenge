<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Infrastructure\Controllers\Api;

use FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Create\CreateOrderCommand;
use FinizensChallenge\InvestmentContext\OrderModule\Application\Query\SearchOrder\SearchOrdersQuery;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderType;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\CommandBus;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryBus;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Controller\BaseApiController;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Response\EmptyResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchOrderController extends BaseApiController
{
    public function __construct(
        private QueryBus $queryBus
    ) {
    }

    #[Route("/orders", methods: ["GET"])]
    public function __invoke(
        Request $request
    ) {
        $command = SearchOrdersQuery::createFromArray(
            $request->query->all()
        );

        $queryResponse = $this->queryBus->handle($command);

        return new JsonResponse($queryResponse);
    }

}
