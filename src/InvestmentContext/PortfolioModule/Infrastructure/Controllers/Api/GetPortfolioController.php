<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Infrastructure\Controllers\Api;

use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\Find\FindPortfolioByIdQuery;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryBus;
use FinizensChallenge\SharedContext\HttpModule\Infrastructure\Controller\BaseApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetPortfolioController extends BaseApiController
{
    public function __construct(
        private QueryBus $queryBus
    ) {
    }

    #[Route("/portfolio/{portfolioId}", methods: ["GET"])]
    public function __invoke(
        Request $request,
        string $portfolioId
    ): JsonResponse {
        $query = FindPortfolioByIdQuery::create($portfolioId);
        $queryResponse = $this->queryBus->handle($query);

        return new JsonResponse($queryResponse);
    }
}
