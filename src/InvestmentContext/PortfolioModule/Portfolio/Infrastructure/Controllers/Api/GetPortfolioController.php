<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Infrastructure\Controllers\Api;

use FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Application\Command\Create\CreatePortfolioCommand;
use FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Application\Query\Find\FindPortfolioByIdQuery;
use FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model\QueryBus;
use FinizensChallenge\SharedContext\HttpModule\Controller\Infrastructure\Controllers\BaseApiController;
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
        $queryResponse = $this->queryBus->ask($query);

        return new JsonResponse($queryResponse);
    }
}
