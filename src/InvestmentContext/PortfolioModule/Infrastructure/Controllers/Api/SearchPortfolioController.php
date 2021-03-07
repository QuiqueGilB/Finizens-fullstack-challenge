<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Infrastructure\Controllers\Api;

use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\SearchPortfolio\SearchPortfoliosQuery;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryBus;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Controller\BaseApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchPortfolioController extends BaseApiController
{
    public function __construct(
        private QueryBus $queryBus
    ) {
    }

    #[Route("/portfolio", methods: ["GET"])]
    public function __invoke(
        Request $request
    ): JsonResponse {
        $query = SearchPortfoliosQuery::create(
            $request->query->get('filters'),
            $request->query->get('order'),
            $request->query->getInt('offset'),
            $request->query->getInt('limit')
        );
        $queryResponse = $this->queryBus->handle($query);

        return new JsonResponse($queryResponse);
    }
}
